@extends('layouts.app')

@section('content')
@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<div>
    <form class="form-create" action="{{ route('planos.update', $plano->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h1>Editar Plano de Estudo</h1>

         <!-- Campo Nota -->
         <div>
            <label class="label-form">Nota:</label><br>
            <textarea class="form-input" id="nota" name="nota" rows="4">{{ old('nota', $plano->nota) }}</textarea>
        </div>

        <div class="dropdown">
            <div class="dropdown-btn" onclick="toggleDropdown('horarioDropdown', 'horarioLabel')">
                <span id="horarioLabel">Selecione Horários</span>
            </div>
            <div class="dropdown-content" id="horarioDropdown">
                @foreach($horarios as $horario)
                    <label>
                        <input type="checkbox" name="horario_id[]" value="{{ $horario->id }}"
                            {{ in_array($horario->id, $plano->horarios->pluck('id')->toArray()) ? 'checked' : '' }}
                            onchange="updateSelected('horarioDropdown', 'horarioLabel')">
                        {{ $horario->inicio }} - {{ $horario->fim }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="dropdown">
            <div class="dropdown-btn" onclick="toggleDropdown('tarefaDropdown', 'tarefaLabel')">
                <span id="tarefaLabel">Selecione Tarefas</span>
            </div>
            <div class="dropdown-content" id="tarefaDropdown">
                @foreach($tarefas as $tarefa)
                    <label>
                        <input type="checkbox" name="tarefa_id[]" value="{{ $tarefa->id }}"
                            {{ in_array($tarefa->id, $plano->tarefas->pluck('id')->toArray()) ? 'checked' : '' }}
                            onchange="updateSelected('tarefaDropdown', 'tarefaLabel')">
                        {{ $tarefa->descricao }}
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="label-form">Status:</label><br>
            <select class="form-input" id="status" name="status" v-model="form.status" required>
                @foreach($statusOptions as $stat)
                    <option value="{{ $stat }}" {{ $plano->statusOptions === $stat ? 'selected' : '' }}>
                        {{ $stat }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Botões -->
        <div class="botoes">
            <button type="submit" class="btn-primary">Atualizar</button>
            <a href="{{ route('planos.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

<style>
    .dropdown {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .dropdown-btn {
        padding: 10px;
        border: 1px solid #ccc;
        width: 100%;
        text-align: left;
        cursor: pointer;
        background-color: #fff;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        width: 100%;
        z-index: 1;
        max-height: 200px;
        overflow-y: auto;
    }

    .dropdown-content label {
        display: block;
        padding: 8px;
        cursor: pointer;
    }

    .dropdown-content label:hover {
        background-color: #f1f1f1;
    }

    .dropdown-content input {
        margin-right: 10px;
    }

    .show { display: block; }
</style>

<script>
    function toggleDropdown(dropdownId, labelId) {
        document.getElementById(dropdownId).classList.toggle("show");
    }

    function updateSelected(dropdownId, labelId) {
        const checkboxes = document.querySelectorAll(`#${dropdownId} input[type="checkbox"]`);
        const selected = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selected.push(checkbox.parentNode.textContent.trim());
            }
        });

        document.getElementById(labelId).innerText = selected.length > 0 ? selected.join(", ") : "Selecione";
    }

    // Mantém o dropdown aberto ao clicar nos checkboxes
    document.querySelectorAll('.dropdown-content').forEach(dropdown => {
        dropdown.addEventListener('click', event => {
            event.stopPropagation();
        });
    });

    // Fecha o dropdown ao clicar fora
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-btn')) {
            let dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    };

    // Atualiza a seleção ao carregar a página
    document.addEventListener('DOMContentLoaded', function() {
        updateSelected('horarioDropdown', 'horarioLabel');
        updateSelected('tarefaDropdown', 'tarefaLabel');
    });
</script>
