<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembrete extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto',
        'data',
        'user_id',
        'lida',
    ];

    /**
     * Relação com o usuário.
     * Um lembrete pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
