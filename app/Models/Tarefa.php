<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = "tarefas";

    protected $fillable = ['descricao', 'tipo', 'disciplina', 'status', 'data_entrega', 'user_id'];


    public static function disciplinas()
    {
        return ['Matemática', 'Português', 'História', 'Ciências', 'Geografia', 'Física', 'Biologia', 'Quimica'];
    }

    public static function tipos()
    {
        return ['tema', 'exercicio', 'projeto', 'resumo'];
    }
}
