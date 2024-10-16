<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorarioRequest extends FormRequest
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
        'disciplina' => 'required|min:5',
        'data' => 'date',
        'inicio' => 'required|date_format:H:i',
        'fim' => 'required|date_format:H:i|after:inicio',
        'status' => 'required',


        ];
    }
}
