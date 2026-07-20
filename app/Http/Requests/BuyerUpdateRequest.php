<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BuyerUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'required|string|max:15',
        ];
    }
}
