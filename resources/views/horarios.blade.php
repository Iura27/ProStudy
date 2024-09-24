@extends('layouts.app') <!-- Certifique-se de que 'layouts.app' é o caminho correto do seu layout principal -->

@section('content')
<div class="container">
    <h1>Lista de Horários</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Disciplina</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
                <tr>
                    <td>{{ $horario->id }}</td>
                    <td>{{ $horario->data }}</td>
                    <td>{{ $horario->inicio }}</td>
                    <td>{{ $horario->fim }}</td>
                    <td>{{ $horario->disciplina }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
