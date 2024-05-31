<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrder extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'building_number' => ['required', 'max:255'],
            'street_name' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'postcode' => ['required', 'max:10'],
            'phone' => ['required', 'max:20'],
        ];
    }
}
