<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Http\Requests\TarefaRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImagemController;
use App\Models\Imagem;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TarefasController extends Controller
{

    public function verificarTarefasAtrasadas()
    {
        // Obtém a data e hora atual e o horário atual mais 30 minutos
        $now = now();
        $nowPlus30 = now()->addMinutes(30);

        // Atualiza o status das tarefas que estão a menos de 30 minutos do prazo para "Quase atrasada"
        Tarefa::where('data_entrega', '>', $now)
            ->where('data_entrega', '<=', $nowPlus30)
            ->whereNotIn('status', ['Atrasada', 'Concluídas', 'Quase atrasada']) // Evita reprocessar tarefas já atrasadas, concluídas ou quase atrasadas
            ->update(['status' => 'Quase atrasada']);

        // Atualiza o status das tarefas já atrasadas para "Atrasada"
        Tarefa::where('data_entrega', '<', $now)
            ->whereNotIn('status', ['Atrasada', 'Concluídas']) // Evita reprocessar tarefas já atrasadas ou concluídas
            ->update(['status' => 'Atrasada']);
    }

    public function index(Request $request) {
        $this->verificarTarefasAtrasadas();

        $search = $request->input('search');
        $user = auth()->user(); // Obtém o usuário autenticado
        $tarefas = Tarefa::where('user_id', $user->id)
            ->when($search, function ($query, $search) {
                return $query->where('descricao', 'like', '%' . $search . '%');
        })
            ->orderByRaw("FIELD(status, 'Concluídas') ASC")
            ->paginate(5);

        $statusOptions = Tarefa::getStatusOptions();
        $agora = now();
        $agora30 = now()->subMinutes(30);

        return view('tarefas.index', ['tarefas' => $tarefas, 'user' => $user, 'statusOptions' => $statusOptions, 'agora' => $agora, 'agora30' => $agora30 ]);
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

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Em andamento,Concluídas,Adiadas,Atrasada,Quase atrasada',
    ]);

    $tarefas = Tarefa::findOrFail($id);
    $tarefas->status = $request->status;
    $tarefas->save();

    return redirect()->back()->with('success', 'Status atualizado com sucesso!');
}

}
