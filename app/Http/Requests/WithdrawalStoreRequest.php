<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawalStoreRequest extends FormRequest
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
            'store_balance_id' => ['required', 'exists:store_balances,id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'bank_account_name' => ['required', 'string'],
            'bank_account_number' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
        ];
    }
}
