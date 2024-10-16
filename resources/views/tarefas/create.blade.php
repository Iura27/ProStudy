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
        <form class="form-create" action="{{ route('tarefas.store') }}" method="POST" >
            @csrf
            <h1>Nova Terefa</h1>

            <!-- Campo Descrição -->
            <div>
                <label class="label-form">Descrição:</label><br>
                <textarea class="form-input" id="descricao" name="descricao" rows="4" required></textarea>
            </div>


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

    <!-- Campo Tipo -->
    <div>
        <label class="label-form">Tipo:</label><br>
    <select class="form-input" id="tipo" name="tipo" v-model="form.tipo" required>
        <option value="" disabled selected>Selecione um tipo</option>
        @foreach($tipos as $tipo)
            <option value="{{ $tipo }}">{{ $tipo }}</option>
            @endforeach
        </select>
    </div>


    <!-- Campo Data -->
    <div>
        <label class="label-form">Data de Entrega:</label><br>
        <input type="date" class="form-input" id="data_entrega" name="data_entrega" v-model="form.data" required />
    </div>


    <!-- Campo Status -->
    <div>
        <label class="label-form">Status:</label><br>
        <select class="form-input" id="status" name="status" required>
            <option value="pendente" >Pendente</option>
            <option value="feito">Feito</option>
        </select>
    </div>

    <!-- Botões -->
    <div class="botoes">
        <button type="submit" class="btn-primary">Cadastrar</button>
        <a href="{{ route('tarefas.index') }}" class="btn-secondary">
            Cancelar
        </a>
    </div>
</form>
    </div>

    @endsection
