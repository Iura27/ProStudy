@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

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
                            <th scope="col"> </th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($planos as $plano)
                        <tr @if($plano->status === 'Concluídas') style="text-decoration: line-through; color: gray; opacity: 0.5;" @endif>
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
                                        {{ Str::limit($tarefa->descricao, 20) }}<br>
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
                             <!-- Botão Ver Detalhes -->
                             <a href="#" class="btn" data-toggle="modal" data-target="#planoModal" onclick="abrirModalPlano({{ json_encode($plano) }}, {{ json_encode($plano->horarios) }}, {{ json_encode($plano->tarefas) }})"
                                >
                                <i class='bx bx-show' style="font-size: 24px; color: green;"></i>
                            </a>

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

<!-- Modal de Visualização dos Planos de Estudo -->
<div class="modal fade" id="planoModal" tabindex="-1" role="dialog" aria-labelledby="planoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planoModalLabel">Detalhes do Plano de Estudo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Horários:</strong></p>
                <ul id="modalHorarios"></ul>

                <p><strong>Tarefas:</strong></p>
                <ul id="modalTarefas"></ul>

                <p><strong>Notas:</strong> <span id="modalNota"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModalPlano(plano, horarios, tarefas) {
        // Preenchendo Horários
        const horariosList = document.getElementById('modalHorarios');
        horariosList.innerHTML = '';
        if (horarios.length > 0) {
            horarios.forEach(horario => {
                const li = document.createElement('li');
                li.textContent = `${horario.inicio} até ${horario.fim}`;
                horariosList.appendChild(li);
            });
        } else {
            horariosList.innerHTML = '<li>Sem Horário</li>';
        }

        // Preenchendo Tarefas
        const tarefasList = document.getElementById('modalTarefas');
        tarefasList.innerHTML = '';
        if (tarefas.length > 0) {
            tarefas.forEach(tarefa => {
                const li = document.createElement('li');
                li.textContent = tarefa.descricao;
                tarefasList.appendChild(li);
            });
        } else {
            tarefasList.innerHTML = '<li>Sem Tarefa</li>';
        }

        // Preenchendo Notas e Status
        document.getElementById('modalNota').textContent = plano.nota || 'Sem Notas';
        document.getElementById('modalStatus').textContent = plano.status;
    }
</script>

@endsection
