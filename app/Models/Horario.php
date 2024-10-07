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
    ];

    public static function disciplinas()
    {
        return ['Matemática', 'Português', 'História', 'Ciências', 'Geografia', 'Física', 'Biologia', 'Quimica'];
    }
}
