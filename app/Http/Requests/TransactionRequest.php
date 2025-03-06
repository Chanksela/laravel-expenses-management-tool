<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'transaction_type' => 'required|in:1,2',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Please provide a description for the transaction.',
            'amount.required' => 'Please specify the transaction amount.',
            'category_id.exists' => 'Selected category does not exist.',
        ];
    }
}
