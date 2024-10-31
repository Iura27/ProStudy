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
        Schema::create('planos_de_estudo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nota')->nullable();
            $table->enum('status', ['Em andamento', 'Concluídas', 'Adiadas', 'Atrasada', 'Quase atrasada'])->default('Em andamento');
            $table->timestamps();
        });

        Schema::create('planos_de_estudo_horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_de_estudo_id')
                  ->constrained('planos_de_estudo')->onDelete('cascade');
            $table->foreignId('horario_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('planos_de_estudo_tarefas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_de_estudo_id')
                  ->constrained('planos_de_estudo')->onDelete('cascade');
            $table->foreignId('tarefa_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planos_de_estudo_tarefas');
        Schema::dropIfExists('planos_de_estudo_horarios');
        Schema::dropIfExists('planos_de_estudo');
    }
};
