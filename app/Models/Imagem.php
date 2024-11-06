<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    use HasFactory;

    protected $table = 'imagens'; // Especifica o nome correto da tabela
    protected $fillable = ['tarefa_id', 'path'];

    public function tarefa()
    {
        return $this->belongsTo(Tarefa::class);
    }
}


