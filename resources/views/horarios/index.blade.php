@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <h4 style="font-weight: 900; font-size: 24px; color: #555 !important; margin-bottom: 10px;">Horários</h4>
        <div class="card-header d-flex justify-content-between align-items-center">

             <!-- Barra de Pesquisa -->
            <div class="search-bar" >
                <form action="{{ route('horarios.index') }}" method="GET" style="display: flex; ">
                    <input
                     style ="width: 400px"
                     type="text"
                     name="search"
                     class="form-input"
                    placeholder="Pesquisar horario por Disciplina..."
                    value="{{ request('search') }}"
                    />
                <button type="submit" class="btn-primary" style="width: 110px; padding-top: 4px; padding-bottom: 4px; height: 45px; margin-top:8px;">Pesquisar</button>
            </form>
            </div>

            <!-- Botão de Criar Novo Horário -->
            <a href="{{ route('horarios.create') }}" class="btn btn-primary">
                Criar Novo Horário
            </a>



<!-- JS do jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JS do Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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
                            <th scope="col">       </th>
                            <th scope="col">Ações</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($horarios as $horario)
                        <tr @if($horario->status === 'Concluídas') style="text-decoration: line-through; color: gray; opacity: 0.5;" @endif>
                            <td>{{ $horario->id }}</td>
                            <td>{{ $horario->disciplina }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->data)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->inicio)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->fim)->format('H:i') }}</td>
                            <td>
                                <form action="{{ route('horarios.updateStatus', $horario->id) }}" method="POST">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="form-select">
                                        @foreach($statusOptions as $stat)
                                            <option value="{{ $stat }}" {{ $horario->status === $stat ? 'selected' : '' }}>
                                                {{ $stat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="#" class="btn" data-toggle="modal" data-target="#horarioModal" onclick="abrirModal('{{ $horario->disciplina }}', '{{ $horario->data }}', '{{ $horario->inicio }}', '{{ $horario->fim }}', '{{ $horario->status }}', '{{ $horario->observacao }}')">
                                    <i class='bx bx-show' style="font-size: 24px; color: green;"></i> <!-- Boxicons -->
                                    <!-- Ou para Font Awesome:
                                    <i class="fas fa-eye" style="font-size: 24px; color: green;"></i>
                                    -->
                                </a>
                            </td>
                            <td>
                               <!-- Botão de Edição -->
<a href="{{ route('horarios.edit', $horario->id) }}" class="btn btn-warning" title="Editar">
    Editar
</a>

<!-- Botão de Exclusão -->
<form action="{{ route('horarios.destroy', $horario->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
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
            <!-- Componente de Paginação -->
         <div class="d-flex justify-end mt-3">
            {{ $horarios->links() }}
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="horarioModal" tabindex="-1" role="dialog" aria-labelledby="horarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="horarioModalLabel">Detalhes do Horário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Disciplina:</strong> <span id="modalDisciplina"></span></p>
                <p><strong>Data:</strong> <span id="modalData"></span></p>
                <p><strong>Início:</strong> <span id="modalInicio"></span></p>
                <p><strong>Fim:</strong> <span id="modalFim"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p><strong>Observação:</strong> <span id="modalObservacao"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModal(disciplina, data, inicio, fim, status, observacao) {
        document.getElementById('modalDisciplina').innerText = disciplina;
        document.getElementById('modalData').innerText = data;
        document.getElementById('modalInicio').innerText = inicio;
        document.getElementById('modalFim').innerText = fim;
        document.getElementById('modalStatus').innerText = status;
        document.getElementById('modalObservacao').innerText = observacao;
    }
    </script>

@endsection
