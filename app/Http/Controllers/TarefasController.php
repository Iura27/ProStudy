<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Http\Requests\TarefaRequest;
use Illuminate\Support\Facades\Auth;





class TarefasController extends Controller
{
    public function index() {
        $tarefas = Tarefa::all();
        $user = auth()->user(); // Obtém o usuário autenticado
        return view('tarefas.index', ['tarefas' => $tarefas, 'user' => $user]); // Passa o usuário para a view
    }

    public function create() {
        $disciplinas = Tarefa::disciplinas();
        $tipos = Tarefa::tipos(); // Corrigido de Terefa para Tarefa
        $user = auth()->user();
        return view('tarefas.create', compact('disciplinas', 'tipos'));
    }

    public function store(TarefaRequest $request) {
        Tarefa::create([

        'descricao' => $request->descricao,
        'disciplina' => $request->disciplina,
        'status' => $request->status,
        'data_entrega' => $request->data_entrega,
        'user_id' => Auth::id(), // Associa o horário ao usuário autenticado
        ]);
        return redirect('tarefas');
    }

    public function destroy($id) {
        Tarefa::find($id)->delete();

        return redirect('tarefas'); // Crie uma view chamada 'create' para o formulário
    }

    public function edit($id) {
        $tarefa = Tarefa::findOrFail($id); // Encontre a tarefa pelo ID
        $tipos = Tarefa::tipos(); // Obtenha os tipos de tarefa
        $disciplinas = Tarefa::disciplinas(); // Obtenha as disciplinas

        return view('tarefas.edit', compact('tarefa', 'disciplinas', 'tipos')); // Passe as variáveis para a view
    }


    public function update(TarefaRequest $request, $id) {
        // Encontre a tarefa pelo ID
        $tarefa = Tarefa::findOrFail($id);

        // Atualize a tarefa com os dados validados
        $tarefa->update($request->validated());

        // Redirecione para a lista de tarefas com uma mensagem de sucesso, se necessário
        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');

    }

}
