<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocation extends FormRequest
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
            'location_name' => 'required|string',
            'street' => 'required|string',
            'street_number' => 'required|string',
            // TODO: implement custom rule to check:
            //       1) correctness of city name;
            //       2) matching between postal code and city.
            'postal_code' => 'required|integer',
            'city' => 'required|string',
            'phone' => 'nullable',
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
            'location_name.required' => 'Merci de donner un nom à ce lieu.',
            'street.required' => 'Cette information est obligatoire.',
            'street_number.required' => 'Le numéro est nécessaire.',
            'postal_code.required' => 'Merci d’indiquer le code postal.',
            'city.required' => 'Vous devez indiquer la ville',
            'email.email' => 'L’adresse e-mail indiquée semble incorrecte.',
        ];
    }
}
