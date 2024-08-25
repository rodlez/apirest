<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        // If there is no user or do not have a token allow to create return false
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        // if the method is not PUT, will be PATCH (use the sometimes rule)
        if ($method === 'PUT') {
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
        } else {
            return [
                'name' => ['sometimes', 'required'],
                'type' => [
                    'sometimes',
                    'required',
                    Rule::in(['I', 'B', 'i', 'b'])
                ],
                'email' => ['sometimes', 'required'],
                'address' => ['sometimes', 'required'],
                'city' => ['sometimes', 'required'],
                'state' => ['sometimes', 'required'],
                'postalCode' => ['sometimes', 'required']
            ];
        }
    }

    /**
     * Change the postalCode JSON value to the postal_code column in the DB
     */

    protected function prepareForValidation()
    {
        // Change only if there is one, in case of PUT or PATCH
        if ($this->postalCode) {
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }
    }
}
