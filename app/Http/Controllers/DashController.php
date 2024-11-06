<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Horario;
use App\Models\PlanoDeEstudo;

class DashController extends Controller
{
    public function index() {
        return view('dash');
    }

    public function dashboard(Request $request)
{
    // Dados gerais
    $totalTarefas = Tarefa::count();
    $totalHorarios = Horario::count();
    $totalPlanos = PlanoDeEstudo::count();

    // Dados para o gráfico de Status das Tarefas
    $tarefasStatus = Tarefa::select('status', \DB::raw('count(*) as total'))
                            ->groupBy('status')
                            ->pluck('total', 'status');

    // Obter lista de disciplinas para o filtro
    $disciplinas = Tarefa::distinct()->pluck('disciplina');

    // Filtro de disciplina e status selecionados pelo usuário
    $filtroDisciplina = $request->input('disciplina');
    $filtroStatus = $request->input('status');

    // Consulta para filtrar tarefas
    $tarefasFiltradas = Tarefa::when($filtroDisciplina, function ($query) use ($filtroDisciplina) {
                                return $query->where('disciplina', $filtroDisciplina);
                            })
                            ->when($filtroStatus, function ($query) use ($filtroStatus) {
                                return $query->where('status', $filtroStatus);
                            })
                            ->get();

    // Dados para o gráfico de Tarefas por Disciplina
    $tarefasPorDisciplina = Tarefa::select('disciplina', \DB::raw('count(*) as total'))
                                    ->groupBy('disciplina')
                                    ->pluck('total', 'disciplina');

    return view('dash', compact(
        'tarefasStatus', 'tarefasPorDisciplina', 'totalTarefas',
        'totalHorarios', 'totalPlanos', 'disciplinas', 'tarefasFiltradas'
    ));
}
}
