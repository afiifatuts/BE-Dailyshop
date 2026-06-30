<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name'=> 'required|string|max:225',
            'logo'=> 'required|mimes:png|max:2048',
            'about'=> 'required|string',
            'phone'=> 'required|string',
            'address_id'=> 'required',
            'city'=> 'required|string',
            'address'=> 'required|string',
            'postal_code'=> 'required|string',

        ];
    }
}
