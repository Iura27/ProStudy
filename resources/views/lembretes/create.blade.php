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
    <form class="form-create" action="{{ route('lembretes.store') }}" method="POST">
        @csrf
        <h1>Novo Lembrete</h1>

        <!-- Campo Texto do Lembrete -->
        <div>
            <label class="label-form">Texto do Lembrete:</label><br>
            <textarea class="form-input" id="texto" name="texto" rows="4" required></textarea>
        </div>

        <!-- Campo Data -->
        <div>
            <label class="label-form">Data:</label><br>
            <input type="date" class="form-input" id="data" name="data" required />
        </div>

        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Cadastrar</button>
            <a href="{{ route('lembretes.index') }}" class="btn-secondary">
                Cancelar
            </a>
        </div>
    </form>
</div>

@endsection
