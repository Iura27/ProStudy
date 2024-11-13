<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Horario;
use App\Models\PlanoDeEstudo;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function dashboard(Request $request)
    {
        // Dados gerais
        $totalTarefas = Tarefa::where('user_id', Auth::id())->count();
        $totalHorarios = Horario::where('user_id', Auth::id())->count();
        $totalPlanos = PlanoDeEstudo::where('user_id', Auth::id())->count();

        // Obter lista de disciplinas para o filtro
        $disciplinas = Tarefa::where('user_id', Auth::id())
                             ->distinct()
                             ->pluck('disciplina');

        // Filtro de disciplina e status selecionados pelo usuário
        $filtroDisciplina = $request->input('disciplina');
        $filtroStatus = $request->input('status');

        // Consulta para filtrar tarefas
        $tarefasFiltradas = Tarefa::where('user_id', Auth::id())
                                ->when($filtroDisciplina, function ($query) use ($filtroDisciplina) {
                                    return $query->where('disciplina', $filtroDisciplina);
                                })
                                ->when($filtroStatus, function ($query) use ($filtroStatus) {
                                    return $query->where('status', $filtroStatus);
                                })
                                ->get();

        // Dados para o gráfico de Status das Tarefas (baseado nas tarefas filtradas)
        $tarefasStatus = $tarefasFiltradas
                            ->groupBy('status')
                            ->map(function ($statusGroup) {
                                return $statusGroup->count();
                            });

        // Obter as opções de status para o filtro
        $statusOptions = Horario::getStatusOptions();


        // Dados para o gráfico de horários agrupados por mês
        $horariosAgrupados = Horario::selectRaw('YEAR(data) as year, MONTH(data) as month, status, COUNT(*) as total')
            ->where('user_id', Auth::id())
            ->groupBy('year', 'month', 'status')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

          

        return view('dash', compact(
            'tarefasStatus', 'totalTarefas', 'totalHorarios', 'totalPlanos',
            'disciplinas', 'tarefasFiltradas', 'statusOptions', 'horariosAgrupados'
        ));
    }
}


