<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = "tarefas";

    protected $fillable = ['descricao', 'tipo', 'disciplina', 'status', 'data_entrega', 'user_id'];

    protected $dates = ['data_entrega'];

    public static function disciplinas()
    {
        return ['Matemática', 'Português', 'História', 'Ciências', 'Geografia', 'Física', 'Biologia', 'Quimica'];
    }


    public static function tipos()
    {
        return ['tema', 'exercicio', 'projeto', 'resumo'];
    }

    public function planosDeEstudo()
    {
        return $this->belongsToMany(PlanoDeEstudo::class, 'planos_de_estudo_tarefas', 'tarefa_id', 'plano_de_estudo_id');
    }

    public static function getStatusOptions()
    {
        return ['Em andamento', 'Concluídas', 'Adiadas', 'Atrasada', 'Quase atrasada'];
    }

    public function imagens()
    {
        return $this->hasMany(Imagem::class);
    }


}
