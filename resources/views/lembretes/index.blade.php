@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Lembretes</h4>
            <!-- Botão de Criar Novo Lembrete -->
            <a href="{{ route('lembretes.create') }}" class="btn btn-primary">
                Criar Novo Lembrete
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Texto do Lembrete</th>
                            <th scope="col">Data</th>
                            <th scope="col">Lida</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lembretes as $lembrete)
                        <tr>
                            <td>{{ $lembrete->id }}</td>
                            <td>{{ $lembrete->texto }}</td>
                            <td>{{ $lembrete->data }}</td>
                            <td>
                                <form action="{{ route('lembretes.update', $lembrete->id) }}" method="POST" id="form-lida-{{ $lembrete->id }}">
                                    @csrf
                                    @method('PUT') <!-- Mudei para PUT -->

                                    <input type="checkbox"
                                           name="lida"
                                           onchange="document.getElementById('form-lida-{{ $lembrete->id }}').submit();"
                                           {{ $lembrete->lida ? 'checked' : '' }}>
                                </form>
                            </td>

                            </td>

                            <td>
                                <!-- Botão de Edição -->
                                <a href="{{ route('lembretes.edit', $lembrete->id) }}" class="btn btn-warning" title="Editar">
                                    Editar
                                </a>

                                <!-- Botão de Exclusão -->
                                <form action="{{ route('lembretes.destroy', $lembrete->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
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
