<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeadOffice extends FormRequest
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
            'street' => 'required|string',
            'street_number' => 'required|string',
            // TODO: implement custom rule to check:
            //       1) correctness of city name;
            //       2) matching between postal code and city.
            'postal_code' => 'required|integer',
            'city' => 'required|string',

            'phone' => 'nullable|required_with:phone_is_public',
            'phone_is_public' => 'nullable',

            'email' => 'nullable|email|required_with:email_is_public',
            'email_is_public' => 'nullable',
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
            'street.required' => 'Cette information est obligatoire.',
            'street_number.required' => 'Le numéro est nécessaire.',
            'postal_code.required' => 'Merci d’indiquer le code postal.',
            'city.required' => 'Vous devez indiquer la ville',
            'phone.required_with' => 'Si vous cochez la case, vous devez indiquer un numéro de téléphone.',
            'email.email' => 'L’adresse e-mail indiquée semble incorrecte.',
            'email.required_with' => 'Si vous cochez la case, vous devez indiquer une adresse e-mail.',
        ];
    }
}
