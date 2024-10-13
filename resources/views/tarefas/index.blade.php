

@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Tarefas</h4>
            <!-- Botão de Criar Novo Horário -->
            <a href="{{ route('tarefas.create') }}" class="btn btn-primary">
                Criar Nova Tarefa
            </a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Disciplina</th>
                                <th scope="col">Data de Entrega</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tarefas as $tarefa)
                        <tr>
                            <td>{{ $tarefa->id }}</td>
                            <td>{{ $tarefa->descricao }}</td>
                            <td>{{ $tarefa->tipo }}</td>
                            <td>{{ $tarefa->disciplina }}</td>
                            <td>{{ $tarefa->data_entrega }}</td>
                            <td>
                                @if($tarefa->status == 'concluido')
                                    <span class="text-success">{{ ucfirst($tarefa->status) }}</span>
                                @else
                                    <span class="text-warning">{{ ucfirst($tarefa->status) }}</span>
                                @endif
                            </td>
                            <td>
                               <!-- Botão de Edição -->
<a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-warning" title="Editar">
    Editar
</a>

<!-- Botão de Exclusão -->
<form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" title="Excluir">
        Excluir
    </button>
</form>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

