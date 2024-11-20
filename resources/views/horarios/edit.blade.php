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
        <h1>Editar Horário</h1>

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

        <!-- Campos Data, Início e Fim em uma linha -->
        <div class="form-group row">
            <div class="col-md-4">
                <label class="label-form">Data:</label><br>
                <input type="date" class="form-input" id="data" name="data" value="{{ $horario->data }}" required />
            </div>

            <div class="col-md-4">
                <label class="label-form">Início:</label><br>
                <input type="time" class="form-input" id="inicio" name="inicio" value="{{ $horario->inicio }}" required />
            </div>

            <div class="col-md-4">
                <label class="label-form">Fim:</label><br>
                <input type="time" class="form-input" id="fim" name="fim" value="{{ $horario->fim }}" required />
            </div>
        </div>

        <!-- Campo Status -->
        <div>
            <label class="label-form">Status:</label><br>
            <select class="form-input" id="status" name="status" required>
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}" {{ $horario->status === $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo Observação -->
        <div>
            <label class="label-form">Observação:</label><br>
            <textarea class="form-input" id="observacao" name="observacao">{{ $horario->observacao }}</textarea>
        </div>

        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Atualizar</button>
            <a href="{{ route('horarios.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
