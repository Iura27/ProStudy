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
        'user_id'
    ];

    public static function disciplinas()
    {
        return ['Matemática', 'Português', 'História', 'Ciências', 'Geografia', 'Física', 'Biologia', 'Quimica'];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
