

@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

<!-- JS do jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JS do Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


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
                                <th scope="col"> </th>
                                <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tarefas as $tarefa)
                        <tr @if($tarefa->status === 'Concluídas') style="text-decoration: line-through; color: gray; opacity: 0.5;" @endif>
                            <td>{{ $tarefa->id }}</td>
                            <td>
                                {{ Str::limit($tarefa->descricao, 16) }}
                            </td>
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
                                <a href="#" class="btn" data-toggle="modal" data-target="#tarefaModal" onclick="abrirModal('{{ e($tarefa->descricao) }}', '{{ e($tarefa->tipo) }}', '{{ e($tarefa->disciplina) }}', '{{ e(\Carbon\Carbon::parse($tarefa->data_entrega)->format('d/m/y - H:i')) }}', '{{ e($tarefa->status) }}',  {{ json_encode($tarefa->imagens) }})"
                                    >
                                    <i class='bx bx-show' style="font-size: 24px; color: green;"></i>
                                </a>

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

<!-- Modal -->
<div class="modal fade" id="tarefaModal" tabindex="-1" role="dialog" aria-labelledby="tarefaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tarefaModalLabel">Detalhes da Tarefa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Descrição:</strong> <span id="modalDescricao"></span></p>
                <p><strong>Tipo:</strong> <span id="modalTipo"></span></p>
                <p><strong>Disciplina:</strong> <span id="modalDisciplina"></span></p>
                <p><strong>Prazo Final:</strong> <span id="modalPrazoFinal"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>

                <p><strong>Imagens:</strong></p>
                <div id="modalImagensContainer" class="image-preview-container">
                    <!-- As imagens serão inseridas aqui -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModal(descricao, tipo, disciplina, prazoFinal, status, imagens) {
    document.getElementById('modalDescricao').innerText = descricao;
    document.getElementById('modalTipo').innerText = tipo;
    document.getElementById('modalDisciplina').innerText = disciplina;
    document.getElementById('modalPrazoFinal').innerText = prazoFinal;
    document.getElementById('modalStatus').innerText = status;

    // Limpa o contêiner de imagens
    const imagensContainer = document.getElementById('modalImagensContainer');
    imagensContainer.innerHTML = '';

    // Adiciona cada imagem como um elemento <img>
    if (imagens.length > 0) {
        imagens.forEach(imagem => {
            const imgElement = document.createElement('div');
            imgElement.classList.add('image-preview');

            const imageTag = document.createElement('img');
            imageTag.src = `{{ asset('storage/') }}/${imagem.path}`; // Certifique-se de que este seja o caminho correto
            imageTag.alt = "Imagem da Tarefa";

            imgElement.appendChild(imageTag);
            imagensContainer.appendChild(imgElement);
        });
    } else {
        imagensContainer.innerHTML = '<p>Nenhuma imagem disponível.</p>';
    }
}

</script>
@endsection

