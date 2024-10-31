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
    <form class="form-create" action="{{ route('lembretes.update', $lembrete->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h1>Editar Lembrete</h1>

        <!-- Campo Texto do Lembrete -->
        <div>
            <label class="label-form">Texto do Lembrete:</label><br>
            <textarea class="form-input" id="texto" name="texto" required>{{ $lembrete->texto }}</textarea>
        </div>

        <!-- Campo Data -->
        <div>
            <label class="label-form">Data:</label><br>
            <input type="date" class="form-input" id="data" name="data" value="{{ $lembrete->data }}" required />
        </div>

        <!-- Checkbox Lida -->
        <div>
            <label class="label-form">Lido:</label><br>
            <input type="checkbox" id="lida" name="lida" {{ $lembrete->lida ? 'checked' : '' }}>
        </div>

        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Atualizar</button>
            <a href="{{ route('lembretes.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
