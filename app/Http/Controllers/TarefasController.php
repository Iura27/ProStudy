<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Http\Requests\TarefaRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImagemController;
use App\Models\Imagem;
use Illuminate\Support\Facades\Storage;

class TarefasController extends Controller
{
    public function index() {
        $user = auth()->user(); // Obtém o usuário autenticado
        $tarefas = Tarefa::where('user_id', $user->id)
            ->orderByRaw("FIELD(status, 'Concluídas') ASC")
            ->get();
        $statusOptions = Tarefa::getStatusOptions();
        return view('tarefas.index', ['tarefas' => $tarefas, 'user' => $user, 'statusOptions' => $statusOptions]);
    }

    public function create() {
        $disciplinas = Tarefa::disciplinas();
        $tipos = Tarefa::tipos();
        $statusOptions = Tarefa::getStatusOptions();
        return view('tarefas.create', compact('disciplinas', 'tipos', 'statusOptions'));
    }

    public function store(TarefaRequest $request) {
        // Cria a tarefa com os dados fornecidos
        $data = $request->only(['descricao', 'disciplina', 'status', 'data_entrega']);
        $data['user_id'] = Auth::id();

        $tarefa = Tarefa::create($data);

        // Salva as imagens, se houver
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('tarefas/imagens', 'public');

                // Cria o registro da imagem associada à tarefa
                $tarefa->imagens()->create(['path' => $path]);
            }
        }

        return redirect('tarefas')->with('success', 'Tarefa criada com sucesso!');
    }

    public function destroy($id) {
        $tarefa = Tarefa::find($id);

        // Exclui a imagem se existir
        if ($tarefa && $tarefa->imagem) {
            \Storage::disk('public')->delete($tarefa->imagem);
        }

        $tarefa->delete();
        return redirect('tarefas')->with('success', 'Tarefa excluída com sucesso!');
    }

    public function edit($id) {
        $tarefa = Tarefa::findOrFail($id);
        $tipos = Tarefa::tipos();
        $disciplinas = Tarefa::disciplinas();
        $statusOptions = Tarefa::getStatusOptions();

        return view('tarefas.edit', compact('tarefa', 'disciplinas', 'tipos', 'statusOptions'));
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);

        // Validação dos dados
        $request->validate([
            'descricao' => 'required|string',
            'data_entrega' => 'required|date',
            'tipo' => 'required',
            'disciplina' => 'required',
            'status' => 'required',
        ]);

        // Atualizar os outros campos da tarefa
        $tarefa->update($request->only(['descricao', 'data_entrega', 'tipo', 'disciplina', 'status']));

        // Adicionar novas imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('imagens', 'public');
                $tarefa->imagens()->create(['path' => $path]);
            }
        }

        // Remover imagens marcadas
        if ($request->has('imagens_removidas')) {
            foreach ($request->imagens_removidas as $imagemId) {
                $imagem = Imagem::find($imagemId);
                if ($imagem) {
                    Storage::disk('public')->delete($imagem->path);
                    $imagem->delete();
                }
            }
        }

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

}
