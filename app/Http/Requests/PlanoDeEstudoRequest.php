<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanoDeEstudoRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Permite a todos os usuários, ajuste conforme necessário
    }

    /**
     * Regras de validação para a solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'horario_id' => 'required|exists:horarios,id',
            'tarefa_id' => 'required|exists:tarefas,id',
            'nota' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Mensagens personalizadas para erros de validação.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'horario_id.required' => 'O campo horário é obrigatório.',
            'horario_id.exists' => 'O horário selecionado não é válido.',
            'tarefa_id.required' => 'O campo tarefa é obrigatório.',
            'tarefa_id.exists' => 'A tarefa selecionada não é válida.',
            'nota.string' => 'O campo notas deve ser um texto.',
            'nota.max' => 'O campo notas não pode ter mais de 1000 caracteres.',
        ];
    }
}
