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

    // Dados para o gráfico de evolução de planos de estudo criados e concluídos
    $planosAgrupados = PlanoDeEstudo::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, status, COUNT(*) as total')
        ->where('user_id', Auth::id())
        ->groupBy('year', 'month', 'status')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->groupBy(function ($item) {
            return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT); // Formato ano-mês
        })
        ->map(function ($monthGroup) {
            $statusData = ['Em andamento' => 0, 'Concluídas' => 0, 'Adiadas' => 0, 'Atrasada' => 0, 'Quase atrasada' => 0];
            foreach ($monthGroup as $statusGroup) {
                $statusData[$statusGroup->status] = $statusGroup->total;
            }
            return $statusData;
        });

    return view('dash', compact(
        'tarefasStatus', 'totalTarefas', 'totalHorarios', 'totalPlanos',
        'disciplinas', 'tarefasFiltradas', 'statusOptions', 'horariosAgrupados', 'planosAgrupados'
    ));
}


}


