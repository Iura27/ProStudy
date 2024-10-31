

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
                                <th scope="col">Prazo final</th>
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
                            <td>
                                <span class="
                                    @if($tarefa->status === 'Atrasada') bg-danger text-white
                                    @elseif($tarefa->status === 'Em andamento') bg-warning text-dark
                                    @elseif($tarefa->status === 'Concluídas') bg-success text-white
                                    @else bg-secondary text-white
                                    @endif
                                    rounded px-2 py-1"
                                    style="font-size: 0.875rem; line-height: 1.2; display: inline-block;">
                                    {{ \Carbon\Carbon::parse($tarefa->data_entrega)->format('d/m/y - H:i') }}
                                </span>
                            </td>


                            <td>
                                <form action="{{ route('tarefas.updateStatus', $tarefa->id) }}" method="POST">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="form-select">
                                        @foreach($statusOptions as $stat)
                                            <option value="{{ $stat }}" {{ $tarefa->status === $stat ? 'selected' : '' }}>
                                                {{ $stat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
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

