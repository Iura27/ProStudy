@extends('layouts.app')

@section('content')
@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div>
    <form class="form-create" action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h1>Editar Tarefa {{ $tarefa->descricao }}</h1>

        <!-- Campo Descrição -->
        <div>
            <label class="label-form">Descrição:</label><br>
            <textarea class="form-input" id="descricao" name="descricao" required>{{ $tarefa->descricao }}</textarea>
        </div>

        <!-- Campo Tipo -->
        <div>
            <label class="label-form">Tipo de Tarefa:</label><br>
            <select class="form-input" id="tipo" name="tipo" required>
                <option value="" disabled>Selecione um tipo</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo }}" {{ $tarefa->tipo == $tipo ? 'selected' : '' }}>
                        {{ $tipo }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo Disciplina -->
        <div>
            <label class="label-form">Disciplina:</label><br>
            <select class="form-input" id="disciplina" name="disciplina" required>
                <option value="" disabled>Selecione uma disciplina</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina }}" {{ $tarefa->disciplina == $disciplina ? 'selected' : '' }}>
                        {{ $disciplina }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-input">
            <label for="dataHora">Data de Entrega:</label>
            <input type="text" id="data_entrega" name="data_entrega" class="form-control" value={{($tarefa->data_entrega) }} required>
        </div>

        <!-- Campo Status -->
        <div>
            <label class="label-form">Status:</label><br>
            <select class="form-input" id="status" name="status" v-model="form.status" required>
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}" {{ $tarefa->status === $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Atualizar</button>
            <a href="{{ route('tarefas.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#data_entrega", {
            enableTime: true,            // Ativa a seleção de hora
            dateFormat: "Y-m-d H:i",     // Formato de data e hora
            time_24hr: true              // Usa o formato de 24 horas
        });
    });
</script>

@endsection
