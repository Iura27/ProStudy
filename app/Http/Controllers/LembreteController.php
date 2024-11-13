<?php

namespace App\Http\Controllers;

use App\Models\Lembrete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LembreteRequest;

class LembreteController extends Controller
{
    // Listar todos os lembretes do usuário autenticado
    public function index() {
        $user = auth()->user();

        $lembretes = Lembrete::where('user_id', $user->id)->get();

        return view('lembretes.index', ['lembretes'=>$lembretes, 'user' => $user]);
    }

    public function create() {
        $user = auth()->user();
        return view('lembretes.create');
    }

    // Criar um novo lembrete
    public function store(LembreteRequest $request) {
        Lembrete::create([

        'texto' => $request->texto,
        'data' => $request->data,
        'user_id' => Auth::id(), // Associa o horário ao usuário autenticado
        ]);
        return redirect('lembretes');
    }

    // Exibir um lembrete específico
    public function show($id)
    {
        $lembrete = Lembrete::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return response()->json($lembrete);
    }




    public function edit($id) {
        $lembrete = Lembrete::findOrFail($id); // Encontre a tarefa pelo ID

        return view('lembretes.edit', compact('lembrete')); // Passe as variáveis para a view
    }





    // Atualizar um lembrete existente
    public function update(Request $request, $id)
{
    $lembrete = Lembrete::findOrFail($id);

    // Verifica se o checkbox 'lida' foi marcado e converte para 1 ou 0
    $lembrete->lida = $request->has('lida') ? 1 : 0;

    $lembrete->save();

    return redirect()->back()->with('status', 'Lembrete atualizado com sucesso!');
}


    // Excluir um lembrete
    public function destroy($id)
    {
        $lembrete = Lembrete::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $lembrete->delete();

        return response()->json(['message' => 'Lembrete excluído com sucesso']);
    }
}
