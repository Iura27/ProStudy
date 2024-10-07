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
    <form class="form-create" action="{{ route('horarios.update', $horario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h1>Editar Horário {{ $horario->inicio }}</h1>

        <!-- Campo Disciplina -->
        <div>
            <label class="label-form">Disciplina:</label><br>
            <select class="form-input" id="disciplina" name="disciplina" required>
                <option value="" disabled>Selecione uma disciplina</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina }}" {{ $horario->disciplina == $disciplina ? 'selected' : '' }}>
                        {{ $disciplina }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo Data -->
        <div>
            <label class="label-form">Data:</label><br>
            <input type="date" class="form-input" id="data" name="data" value="{{ $horario->data }}" required />
        </div>

        <!-- Campo Início -->
        <div>
            <label class="label-form">Início:</label><br>
            <input type="time" class="form-input" id="inicio" name="inicio" value="{{ $horario->inicio }}" required />
        </div>

        <!-- Campo Fim -->
        <div>
            <label class="label-form">Fim:</label><br>
            <input type="time" class="form-input" id="fim" name="fim" value="{{ $horario->fim }}" required />
        </div>

        <!-- Campo Status -->
        <div>
            <label class="label-form">Status:</label><br>
            <select class="form-input" id="status" name="status" required>
                <option value="pendente" {{ $horario->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="concluido" {{ $horario->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Atualizar</button>
            <a href="{{ route('horarios.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
