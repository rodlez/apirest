<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        // If there is no user or do not have a token allow to create return false
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'type' => [
                'required',
                Rule::in(['I', 'B', 'i', 'b'])
            ],
            'email' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'postalCode' => ['required']
        ];
    }

    /**
     * Change the postalCode JSON value to the postal_code column in the DB
     */

    protected function prepareForValidation()
    {
        $this->merge([
            'postal_code' => $this->postalCode
        ]);
    }
}
