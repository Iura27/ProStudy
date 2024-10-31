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
    <form class="form-create" action="{{ route('horarios.store') }}" method="POST">
        @csrf
        <h1>Novo Horário</h1>

        <!-- Campo Disciplina -->
        <div>
            <label class="label-form">Disciplina:</label><br>
            <select class="form-input" id="disciplina" name="disciplina" v-model="form.disciplina" required>
                <option value="" disabled selected>Selecione uma disciplina</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina }}">{{ $disciplina }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campos Data, Início e Fim em uma linha -->
        <div class="form-group row">
            <div class="col-md-4">
                <label class="label-form">Data:</label><br>
                <input type="date" class="form-input" id="data" name="data" v-model="form.data" required />
            </div>

            <div class="col-md-4">
                <label class="label-form">Início:</label><br>
                <input type="time" class="form-input" id="inicio" name="inicio" v-model="form.inicio" required />
            </div>

            <div class="col-md-4">
                <label class="label-form">Fim:</label><br>
                <input type="time" class="form-input" id="fim" name="fim" v-model="form.fim" required />
            </div>
        </div>

        <!-- Campo Status -->
        <div>
            <label class="label-form">Status:</label><br>
            <select class="form-input" id="status" name="status" required>
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}" {{ (isset($horario) && $horario->status === $status) ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="label-form">Observação:</label><br>
            <textarea class="form-input" id="observacao" name="observacao"></textarea>
        </div>

        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Cadastrar</button>
            <a href="{{ route('horarios.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
