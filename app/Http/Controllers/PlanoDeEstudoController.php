<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanoDeEstudo;
use App\Models\Horario;
use App\Models\Tarefa;

class PlanoDeEstudoController extends Controller
{
    public function index()
    {
        $statusOptions = PlanoDeEstudo::getStatusOptions();
        $planos = PlanoDeEstudo::with('horarios', 'tarefas')  // Corrigido para 'horarios' e 'tarefas'
            ->where('user_id', auth()->id())
            ->get();
        return view('planos.index', compact('planos' , 'statusOptions'));
    }

    public function create()
    {
        $horarios = Horario::where('user_id', auth()->id())->get();
        $tarefas = Tarefa::where('user_id', auth()->id())->get();
        $statusOptions = PlanoDeEstudo::getStatusOptions();
        return view('planos.create', compact('horarios', 'tarefas', 'statusOptions'));
    }

    public function store(Request $request)
{
    // Validação dos dados
    $request->validate([
        'horario_id' => 'required|array', // Horários como array para múltipla seleção
        'tarefa_id' => 'required|array',  // Tarefas como array para múltipla seleção
        'nota' => 'nullable|string',

    ]);

    // Criação do plano de estudo
    $planoDeEstudo = PlanoDeEstudo::create([
        'user_id' => auth()->id(),
        'nota' => $request->nota,
    ]);

    // Associa os horários e tarefas selecionados ao plano de estudo
    $planoDeEstudo->horarios()->attach($request->horario_id);
    $planoDeEstudo->tarefas()->attach($request->tarefa_id);

    return redirect()->route('planos.index')->with('success', 'Plano de Estudo criado com sucesso.');
}

public function destroy($id)
{
    // Encontra o plano de estudo pelo ID
    $plano = PlanoDeEstudo::findOrFail($id);

    // Remove o plano de estudo
    $plano->delete();

    // Redireciona para a lista de planos com uma mensagem de sucesso
    return redirect()->route('planos.index')->with('success', 'Plano de Estudo excluído com sucesso.');
}

public function edit($id)
{
    $plano = PlanoDeEstudo::with(['horarios', 'tarefas'])->findOrFail($id);
    $horarios = Horario::where('user_id', auth()->id())->get();
    $tarefas = Tarefa::where('user_id', auth()->id())->get();
    $statusOptions = PlanoDeEstudo::getStatusOptions();

    return view('planos.edit', compact('plano', 'horarios', 'tarefas', 'statusOptions'));
}

public function update(Request $request, $id)
{
    // Validação dos dados
    $request->validate([
        'horario_id' => 'array', // Horários como array para múltipla seleção
        'tarefa_id' => 'array',  // Tarefas como array para múltipla seleção
        'nota' => 'nullable|string',
        'status' => 'required|in:Em andamento,Concluídas,Adiadas,Atrasada,Quase atrasada',
    ]);

    // Encontra o plano de estudo pelo ID
    $plano = PlanoDeEstudo::findOrFail($id);

    // Atualiza o plano de estudo
    $plano->update([
        'nota' => $request->nota,
    ]);

    // Sincroniza os horários e tarefas selecionados
    $plano->horarios()->sync($request->horario_id);
    $plano->tarefas()->sync($request->tarefa_id);

    return redirect()->route('planos.index')->with('success', 'Plano de Estudo atualizado com sucesso!');
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Em andamento,Concluídas,Adiadas,Atrasada,Quase atrasada',
    ]);

    $plano = PlanoDeEstudo::findOrFail($id);
    $plano->status = $request->status;
    $plano->save();

    return redirect()->back()->with('success', 'Status atualizado com sucesso!');
}



}
