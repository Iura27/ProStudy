<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LembreteRequest extends FormRequest
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
            'texto' => 'required|string|max:255', // Texto do lembrete é obrigatório, tipo string, com no máximo 255 caracteres.
            'data' => 'required|date', // Data é obrigatória e deve estar em formato de data válido.
            'lida' => 'boolean', // Lido é obrigatório e deve ser booleano (0 ou 1).
            // O
        ];
    }
}
