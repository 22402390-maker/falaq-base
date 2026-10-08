<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerguntaRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * TICKET #001: Implemente aqui as regras de validação estritas.
     * Requisitos:
     * - texto: obrigatório, string, mínimo de 10 caracteres, máximo de 255.
     * - evento_id: obrigatório, deve existir na tabela eventos.
     */
    public function messages(): array
    {
        return [
            'texto.required' => 'Escreva sua pergunta antes de enviar.',
            'texto.min'      => 'A pergunta precisa ter pelo menos :min caracteres.',
            'texto.max'      => 'A pergunta pode ter no máximo :max caracteres.',
        ];
    }

    public function rules(): array
    {
        return [
            'texto' => ['required', 'string', 'min:10', 'max:255'],
        ];
    }
}
