<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'type'             => 'required|in:income,expense',
            'amount'           => 'required|numeric|min:0',
            'isRecurring'      => 'required|boolean',
            'category_id'      => 'required|exists:categories,id',
            'transaction_date' => 'nullable|date'
        ];
    }

    public function messages()
{
    return [
        'title.required' => 'O título é obrigatório.',
        'title.string'   => 'O título deve ser um texto válido.',
        'title.max'      => 'O título não pode ultrapassar 255 caracteres.',

        'description.string' => 'A descrição deve ser um texto válido.',

        'type.required' => 'O tipo da transação é obrigatório.',
        'type.in'       => 'O tipo deve ser "income" ou "expense".',

        'amount.required' => 'O valor é obrigatório.',
        'amount.numeric'  => 'O valor deve ser numérico.',
        'amount.min'      => 'O valor não pode ser negativo.',

        'isRecurring.required' => 'Informe se a transação é recorrente.',
        'isRecurring.boolean'  => 'O campo recorrente deve ser verdadeiro ou falso.',

        'category_id.required' => 'A categoria é obrigatória.',
        'category_id.exists'   => 'A categoria selecionada não existe.',

        'transaction_date.date' => 'A data informada é inválida.',
    ];
}
}
