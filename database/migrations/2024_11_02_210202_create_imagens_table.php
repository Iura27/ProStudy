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
        Schema::create('imagens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarefa_id');
            $table->string('path');
            $table->timestamps();

            // Define a chave estrangeira para a tabela de tarefas
            $table->foreign('tarefa_id')->references('id')->on('tarefas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagems');
    }
};
