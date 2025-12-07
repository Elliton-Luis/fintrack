<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'=>'required|email|exists:users,email',
            'password' =>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'=>'Necessario informar o email',
            'email.email'=>'Necessario informar um email valido',
            'email.exists'=>'Credenciais Inválidas',
            'password.required'=>'Necessario informar a senha',
        ];
    }
}
