<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = "horarios";
    protected $fillable = [
        'disciplina',
        'data',
        'inicio',
        'fim',
        'status',
        'observacao',
        'user_id'
    ];

    public static function disciplinas()
    {
        return ['Matemática', 'Português', 'História', 'Ciências', 'Geografia', 'Física', 'Biologia', 'Quimica'];
    }

    public static function getStatusOptions()
    {
        return ['Em andamento', 'Concluídas', 'Adiadas', 'Atrasada', 'Quase atrasada'];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function planosDeEstudo()
    {
        return $this->belongsToMany(PlanoDeEstudo::class, 'planos_de_estudo_horarios', 'horario_id', 'plano_de_estudo_id');
    }
}
