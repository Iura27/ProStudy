<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Controllers\TarefasController;
use App\Models\Tarefa;
use app\Http\Controllers\HorarioController;
use App\Models\Horario;
use app\Http\Controllers\PlanoDeEstudoController;
use App\Models\PlanoDeEstudo;

class DashController extends Controller
{
    public function index() {
        return view('dash');
    }

    public function dashboard() {
        $tarefasStatus = Tarefa::select('status', \DB::raw('count(*) as total'))
                                ->groupBy('status')
                                ->pluck('total', 'status');

        $totalTarefas = Tarefa::count();
        $totalHorarios = Horario::count();
        $totalPlanos = PlanoDeEstudo::count();

        return view('dash', compact('tarefasStatus', 'totalTarefas', 'totalHorarios', 'totalPlanos'));
    }


}
