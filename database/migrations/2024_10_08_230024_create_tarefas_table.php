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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao'); // Descrição da tarefa
            $table->enum('tipo', ['tema', 'exercicio', 'projeto', 'resumo']); // Tipo de tarefa
            $table->enum('disciplina', ['Matemática', 'Português', 'História', 'Ciências', 'Geografia', 'Física', 'Biologia', 'Química']); // Disciplina
            $table->enum('status', ['Em andamento', 'Concluídas', 'Adiadas', 'Atrasada', 'Quase atrasada'])->default('Em andamento');
            $table->date('data_entrega'); // Data de entrega
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
