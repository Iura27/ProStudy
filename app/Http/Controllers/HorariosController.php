<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Http\Requests;

class HorariosController extends Controller
{
    public function index() {
        $horarios = Horario::All();
        return view('horarios.index', ['horarios'=>$horarios]);
    }

    public function create() {
        $disciplinas = Horario::disciplinas();
        return view('horarios.create',  compact('disciplinas')); // Crie uma view chamada 'create' para o formulário
    }

    public function store(Request $request) {
        $novo_horario = $request->all();
        Horario::create($novo_horario);

        return redirect('horarios'); // Crie uma view chamada 'create' para o formulário
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
