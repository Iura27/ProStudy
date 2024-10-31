@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Planos de Estudo</h4>
            <!-- Botão de Criar Novo Plano de Estudo -->
            <a href="{{ route('planos.create') }}" class="btn btn-primary">
                Criar Plano de Estudo
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Horário</th>
                            <th scope="col">Tarefa</th>
                            <th scope="col">Notas</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($planos as $plano)
                        <tr>
                            <td>{{ $plano->id }}</td>
                            <td>
                                @if($plano->horarios->isNotEmpty())
                                    @foreach($plano->horarios as $horario)
                                        {{ $horario->inicio }} até {{ $horario->fim }}<br>
                                    @endforeach
                                @else
                                    Sem Horário
                                @endif
                            </td>
                            <td>
                                @if($plano->tarefas->isNotEmpty())
                                    @foreach($plano->tarefas as $tarefa)
                                        {{ $tarefa->descricao }}<br>
                                    @endforeach
                                @else
                                    Sem Tarefa
                                @endif
                            </td>
                            <td>{{ $plano->nota }}</td>
                            <td>
                                <form action="{{ route('horarios.updateStatus', $plano->id) }}" method="POST">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="form-select">
                                        @foreach($statusOptions as $stat)
                                            <option value="{{ $stat }}" {{ $plano->status === $stat ? 'selected' : '' }}>
                                                {{ $stat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <!-- Botão de Edição -->
                                <a href="{{ route('planos.edit', $plano->id) }}" class="btn btn-warning" title="Editar">
                                    Editar
                                </a>

                                <!-- Botão de Exclusão -->
                                <form action="{{ route('planos.destroy', $plano->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
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
