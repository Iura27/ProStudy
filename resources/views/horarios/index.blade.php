@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Horários</h4>
            <!-- Botão de Criar Novo Horário -->
            <a href="{{ route('horarios.create') }}" class="btn btn-primary">
                Criar Novo Horário
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Disciplina</th>
                            <th scope="col">Data</th>
                            <th scope="col">Início</th>
                            <th scope="col">Fim</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horarios as $horario)
                        <tr>
                            <td>{{ $horario->id }}</td>
                            <td>{{ $horario->disciplina }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->data)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->inicio)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->fim)->format('H:i') }}</td>
                            <td>
                                @if($horario->status == 'concluido')
                                    <span class="text-success">{{ ucfirst($horario->status) }}</span>
                                @else
                                    <span class="text-warning">{{ ucfirst($horario->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Ícone de Edição -->
                                <a href="{{ route('horarios.edit', $horario->id) }}" class="text-primary" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Ícone de Exclusão -->
                                <form action="{{ route('horarios.destroy', $horario->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger" title="Excluir" style="border: none; background: none;">
                                        <i class="fas fa-trash"></i>
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
