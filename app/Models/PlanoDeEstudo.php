<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanoDeEstudo extends Model
{
    use HasFactory;

    protected $table = 'planos_de_estudo';

    protected $fillable = ['user_id', 'horario_id', 'tarefa_id', 'nota'];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'planos_de_estudo_horarios');
    }

    public function tarefas()
    {
        return $this->belongsToMany(Tarefa::class, 'planos_de_estudo_tarefas');
    }

    public static function getStatusOptions()
    {
        return ['Em andamento', 'Concluídas', 'Adiadas', 'Atrasada', 'Quase atrasada'];
    }

}
