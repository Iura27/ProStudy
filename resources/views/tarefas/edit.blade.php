@extends('layouts.app')

@section('content')
@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

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

        <!-- Campo Data de Entrega -->
        <div>
            <label class="label-form">Data de Entrega:</label><br>
            <input type="date" class="form-input" id="data_entrega" name="data_entrega" value="{{ $tarefa->data_entrega }}" required />
        </div>

        <!-- Campo Status -->
        <div>
            <label class="label-form">Status:</label><br>
            <select class="form-input" id="status" name="status" required>
                <option value="pendente" {{ $tarefa->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="feito" {{ $tarefa->status == 'feito' ? 'selected' : '' }}>Feito</option>
            </select>
        </div>

        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Atualizar</button>
            <a href="{{ route('tarefas.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
