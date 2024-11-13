@extends('layouts.app')

@section('content')
@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div>
    <form class="form-create" action="{{ route('tarefas.update', $tarefa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <h1>Editar Tarefa {{ $tarefa->id }}</h1>

        <!-- Campo Descrição  -->
        <div class="input-group mb-4">
            <textarea class="form-input" name="descricao" style="height: 150px" placeholder="Descrição da tarefa" required>{{ $tarefa->descricao }}</textarea>

             <!-- Input de upload oculto -->
    <input id="file_input" type="file" name="imagens[]" accept="image/*" multiple style="display: none;" onchange="displayFileName(this)">

    <!-- Botão estilizado para acionar o input de upload -->
    <button type="button" onclick="document.getElementById('file_input').click()"
            style="background-color: #1f3d7a; color: white; padding: 8px 16px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px;">
        Anexar Imagens
    </button>
        </div>

        <!-- Local para exibir pré-visualização das imagens (inicialmente invisível) -->
        <div id="previewImagens" style="margin-top: 10px; display: inline-flex; gap: 10px; flex-wrap: wrap;"></div>


       <!-- Container para pré-visualização das Imagens Existentes -->
<div class="image-preview-container">
    @if($tarefa->imagens)
        @foreach($tarefa->imagens as $imagem)
            <div class="image-preview">
                <img src="{{ asset('storage/' . $imagem->path) }}" alt="Imagem da Tarefa">

                <!-- Checkbox para remover imagem -->
                <div class="checkbox-container">
                    <input type="checkbox" name="imagens_removidas[]" value="{{ $imagem->id }}">
                    <label for="imagens_removidas[]">Remover</label>
                </div>
            </div>
        @endforeach
    @endif
</div>


            <!-- Campo Descrição -->
            <div>
                <label class="label-form">Descrição:</label><br>
                <textarea class="form-input" id="descricao" name="descricao" required>{{ $tarefa->descricao }}</textarea>
            </div>

            <!-- Campo Tipo -->
            <div>
                <label class="label-form">Tipo de Tarefa:</label><br>
                <select class="form-input" id="tipo" name="tipo" required>
                    <option value="" disabled>Selecione um tipo</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo }}" {{ $tarefa->tipo == $tipo ? 'selected' : '' }}>
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo Disciplina -->
            <div>
                <label class="label-form">Disciplina:</label><br>
                <select class="form-input" id="disciplina" name="disciplina" required>
                    <option value="" disabled>Selecione uma disciplina</option>
                    @foreach($disciplinas as $disciplina)
                        <option value="{{ $disciplina }}" {{ $tarefa->disciplina == $disciplina ? 'selected' : '' }}>
                            {{ $disciplina }}
                        </option>
                    @endforeach
                </select>
            </div>


        <div class="form-input">
            <label for="dataHora">Data de Entrega:</label>
            <input type="text" id="data_entrega" name="data_entrega" class="form-control" value={{($tarefa->data_entrega) }} required>
        </div>

        <!-- Campo Status -->
        <div>
            <label class="label-form">Status:</label><br>
            <select class="form-input" id="status" name="status" v-model="form.status" required>
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}" {{ $tarefa->status === $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Atualizar</button>
            <a href="{{ route('tarefas.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#data_entrega", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            //defaultDate: {{ \Carbon\Carbon::parse($tarefa->data_entrega)->format('Y-m-d H:i') }} // Valor inicial
        });
    });

    document.getElementById('file_input').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewDiv = document.getElementById('previewImagens');

        // Limpa a pré-visualização atual
        previewDiv.innerHTML = "";

        // Se houver arquivos, exibe a div de pré-visualização
        if (files.length > 0) {
            previewDiv.style.display = 'flex';
        } else {
            previewDiv.style.display = 'none';
        }

        // Loop para pré-visualizar cada imagem
        Array.from(files).forEach((file, index) => {
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.style.position = 'relative';
                    imgContainer.style.display = 'inline-block';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = "Pré-visualização";
                    img.style.maxWidth = "100px";
                    img.style.marginTop = "10px";
                    img.style.border = "1px solid #ccc";
                    img.style.borderRadius = "4px";
                    img.style.display = 'inline-block'

                    // Botão X para remover imagem
                    const closeButton = document.createElement('button');
                    closeButton.innerHTML = '&times;';
                    closeButton.style.position = 'absolute';
                    closeButton.style.top = '8px';
                    closeButton.style.heigth = '20px';
                    closeButton.style.width = '20px';
                    closeButton.style.right = '0px';
                    closeButton.style.backgroundColor = '#9E2323';
                    closeButton.style.color = '#fff';
                    closeButton.style.border = 'none';
                    closeButton.style.borderRadius = '50%';
                    closeButton.style.cursor = 'pointer';

                    // Adiciona evento para remover a imagem da visualização
                    closeButton.onclick = () => imgContainer.remove();

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(closeButton);
                    previewDiv.appendChild(imgContainer);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>


@endsection
