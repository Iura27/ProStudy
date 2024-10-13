<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->enum('disciplina', ['Matemática', 'Português', 'História', 'Ciências', 'Geografia', 'Física', 'Biologia', 'Quimica']); // Nome da disciplina ou atividade
            $table->date('data'); // Data do horário de estudo
            $table->time('inicio'); // Hora de início do estudo
            $table->time('fim'); // Hora de término do estudo
            $table->string('status')->default('ativo');
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    }
};
