<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepresentatives extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('add partners');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // If the form is skipped, we set no rule.
        if ($this->has('skip')) {
            return [];
        }

        return [
            // Set the rules for all the persons.
            'representatives.*.given_name' =>
                'nullable|'.
                // A given name is mandatory if a surname or a role is specified.
                'required_with:representatives.*.surname,representatives.*.role',
            'representatives.*.surname' =>
                'nullable|'.
                // A surname is mandatory if a given name or a role is specified.
                'required_with:representatives.*.given_name,representatives.*.role',
            'representatives.*.role' =>
                'nullable|'.
                // A role is mandatory if a given name or surname is specified.
                'required_with:representatives.*.given_name,representatives.*.surname',
            'representatives.*.email' => 'nullable|email',
            'representatives.*.phone' => 'nullable',

            // Then, explicitly make the first three fields mandatory for the
            // first person (because we need at least one representative).
            'representatives.0.given_name' => 'required|string',
            'representatives.0.surname' => 'required|string',
            'representatives.0.role' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'representatives.*.given_name.required' =>
                'Indiquez le prénom de cette personne.',
            'representatives.*.given_name.required_with' =>
                'En plus du nom et du rôle, vous devez également indiquer un prénom.',
            'representatives.*.surname.required' =>
                'Merci d’indiquer le nom de cette personne.',
            'representatives.*.surname.required_with' =>
                'En plus du prénom et du rôle, vous devez également indiquer un nom.',
            'representatives.*.role.required' =>
                'Merci d’indiquer le rôle ou la fonction de cette personne.',
            'representatives.*.role.required_with' =>
                'En plus de son prénom et de son nom, vous devez également indiquer le rôle ou la fonction de cette personne.',
            'representatives.*.email.email' =>
                'L’adresse e-mail indiquée semble incorrecte.',
        ];
    }
}
