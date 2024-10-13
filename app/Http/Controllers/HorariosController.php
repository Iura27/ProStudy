<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Http\Requests\HorarioRequest;
use Illuminate\Support\Facades\Auth;

class HorariosController extends Controller
{


        public function __construct()
        {
            // Garantir que apenas usuários autenticados possam acessar esses métodos
            $this->middleware('auth');
        }



    public function index() {
        $horarios = Horario::All();
        return view('horarios.index', ['horarios'=>$horarios]);
    }

    public function create() {
        $disciplinas = Horario::disciplinas();
        $user = auth()->user();
        return view('horarios.create',  compact('disciplinas')); // Crie uma view chamada 'create' para o formulário
    }

    public function store(HorarioRequest $request) {
        Horario::create([
            'disciplina' => $request->disciplina,
            'data' => $request->data,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
            'status' => $request->status, // Utilize o status enviado no formulário
            'user_id' => Auth::id(), // Associa o horário ao usuário autenticado
        ]);
        return redirect('horarios');
    }

    public function destroy($id) {
        Horario::find($id)->delete();

        return redirect('horarios'); // Crie uma view chamada 'create' para o formulário
    }

    public function edit($id) {
       $disciplinas = Horario::disciplinas();
       $horario =  Horario::find($id);

        return view('horarios.edit', compact('horario'), compact('disciplinas')); // Crie uma view chamada 'create' para o formulário
    }

    public function update(Request $request, $id) {
       $disciplinas = Horario::disciplinas();
       Horario::find($id)->update($request->all());

         return redirect('horarios');
     }

}
