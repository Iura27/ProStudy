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
    <form class="form-create" action="{{ route('tarefas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Campo Descrição -->
        <div>
            <label class="label-form">Descrição:</label>
            <textarea class="form-input" name="descricao" style="height: 150px" placeholder="Descrição da tarefa"></textarea>

              <!-- Input de upload oculto -->
    <input id="file_input" type="file" name="imagens[]" accept="image/*" multiple style="display: none;" onchange="displayFileName(this)">

    <!-- Botão estilizado para acionar o input de upload -->
    <button type="button" onclick="document.getElementById('file_input').click()"
            style="background-color: #1f3d7a; color: white; padding: 8px 16px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;">
        Anexar Imagens
    </button>
    <!-- Local para exibir pré-visualização das imagens -->
    <div id="previewImagens" style="display: inline-flex; gap: 6px; margin-top: 6px; flex-wrap: wrap;"></div>

        </div>





        <!-- Outros Campos do Formulário -->
        <div class="form-group mt-3">
            <label for="disciplina" class="label-form">Disciplina:</label>
            <select class="form-input" id="disciplina" name="disciplina" required>
                <option value="" disabled selected>Selecione uma disciplina</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina }}">{{ $disciplina }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="tipo" class="label-form">Tipo:</label>
            <select class="form-input" id="tipo" name="tipo" required>
                <option value="" disabled selected>Selecione um tipo</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="data_entrega">Prazo final:</label>
            <input type="date" class="form-input" id="data_entrega" name="data_entrega" required />
        </div>

        <div class="form-group mt-3">
            <label for="status" class="label-form">Status:</label>
            <select class="form-input" id="status" name="status" required>
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botões -->
        <div class="botoes mt-4">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{ route('tarefas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#data_entrega", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
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
