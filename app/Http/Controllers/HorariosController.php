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

        public function verificarHorariosAtrasados()
        {
            // Obtém a data e hora atual e o horário atual mais 30 minutos
            $now = now();
            $nowPlus30 = now()->addMinutes(30);

            // Atualiza o status dos horários que estão a menos de 30 minutos do fim para "Quase atrasada"
            Horario::whereRaw("STR_TO_DATE(CONCAT(data, ' ', fim), '%Y-%m-%d %H:%i:%s') > ?", [$now])
                ->whereRaw("STR_TO_DATE(CONCAT(data, ' ', fim), '%Y-%m-%d %H:%i:%s') <= ?", [$nowPlus30])
                ->whereNotIn('status', ['Atrasada', 'Concluída', 'Quase atrasada']) // Evita reprocessar horários já atualizados
                ->update(['status' => 'Quase atrasada']);

            // Atualiza o status dos horários já atrasados para "Atrasada"
            Horario::whereRaw("STR_TO_DATE(CONCAT(data, ' ', fim), '%Y-%m-%d %H:%i:%s') < ?", [$now])
                ->whereNotIn('status', ['Atrasada', 'Concluída']) // Evita reprocessar horários já atrasados ou concluídos
                ->update(['status' => 'Atrasada']);
        }



    public function index(Request $request) {
        $search = $request->input('search');
        $user = auth()->user();
        $this->verificarHorariosAtrasados();
        $horarios = Horario::where('user_id', $user->id)
            ->orderByRaw("FIELD(status, 'Concluídas') ASC")
            ->when($search, function ($query, $search) {
                return $query->where('disciplina', 'like', '%' . $search . '%');
        })
            ->paginate(5);
        $statusOptions = Horario::getStatusOptions();
        return view('horarios.index', ['horarios'=>$horarios, 'statusOptions' => $statusOptions]);
    }

    public function create() {
        $disciplinas = Horario::disciplinas();
        $user = auth()->user();
        $statusOptions = Horario::getStatusOptions();
        return view('horarios.create',  compact('disciplinas', 'statusOptions')); // Crie uma view chamada 'create' para o formulário
    }

    public function store(HorarioRequest $request) {
        Horario::create([
            'disciplina' => $request->disciplina,
            'data' => $request->data,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
            'status' => $request->status, // Utilize o status enviado no formulário
            'observacao' => $request->observacao,
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
       $statusOptions = Horario::getStatusOptions();
       $horario =  Horario::find($id);

       return view('horarios.edit', compact('horario', 'disciplinas', 'statusOptions'));
    }

    public function update(Request $request, $id) {
       $disciplinas = Horario::disciplinas();
       Horario::find($id)->update($request->all());

         return redirect('horarios');
     }




public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Em andamento,Concluídas,Adiadas,Atrasada,Quase atrasada',
    ]);

    $horario = Horario::findOrFail($id);
    $horario->status = $request->status;
    $horario->save();

    return redirect()->back()->with('success', 'Status atualizado com sucesso!');
}


}
