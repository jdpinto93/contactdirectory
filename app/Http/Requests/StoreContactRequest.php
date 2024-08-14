<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'phone' => ['required', 'max:50'],
            'address' => ['required', 'max:100'],
            'city' => ['required', 'max:50'],
            'state' => ['required', 'max:50'],
            'postal_code' => ['required', 'max:20'],
            'organization_id' => ['required', 'exists:organizations,id'],
            'country_id' => ['required', 'exists:countries,id'],
        ];
    }
}
