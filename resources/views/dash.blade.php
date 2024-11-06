@extends('layouts.app')

@section('content')
<router-view></router-view>

<head>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.3/dist/echarts.min.js"></script>
</head>

<script>
    // Converte os dados de PHP para JavaScript
    var tarefasStatusData = @json($tarefasStatus);
</script>

<div class="container-fluid dashboard">
    <div class="content-header">
        <h1>Dashboard</h1>
    </div>
    <br><br>

    <!-- Row dos Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-inbox icon-home bg-primary text-light"></i>
                        </div>
                        <div class="col-8">
                            <p style="font-size: 20px">Tarefas</p>
                            <h5>{{ $totalTarefas }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-clipboard-list icon-home bg-success text-light"></i>
                        </div>
                        <div class="col-8">
                            <p style="font-size: 20px">Horários</p>
                            <h5>{{ $totalHorarios }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-chart-bar icon-home bg-info text-light"></i>
                        </div>
                        <div class="col-8">
                            <p style="font-size: 20px">Planos</p>
                            <h5>{{ $totalPlanos }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Status das Tarefas -->
    <div id="tarefasStatusChart" style="width: 100%; height: 400px;"></div>

    <script>
        var chartDom = document.getElementById('tarefasStatusChart');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            title: { text: 'Status das Tarefas', left: 'center' },
            tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
            xAxis: {
                type: 'category',
                data: [
                    @foreach($tarefasStatus as $status => $total)
                        '{{ $status }}',
                    @endforeach
                ],
                axisLabel: { interval: 0, rotate: 45 }
            },
            yAxis: { type: 'value', minInterval: 1 },
            series: [
                {
                    name: 'Tarefas',
                    type: 'bar',
                    data: [
                        @foreach($tarefasStatus as $total)
                            {{ $total }} ,
                        @endforeach
                    ],
                    itemStyle: {
                        color: function(params) {
                            const colorPalette = ['#4CAF50', '#FF5722', '#FFC107', '#2196F3', '#9C27B0'];
                            return colorPalette[params.dataIndex % colorPalette.length];
                        }
                    }
                }
            ]
        };

        option && myChart.setOption(option);
    </script>

    <!-- Filtro por Disciplina e Status -->
    <div class="mb-4">
        <form method="GET" action="{{ route('dash') }}">
            <div class="form-group">
                <label for="disciplinaSelect">Selecionar Disciplina:</label>
                <select name="disciplina" id="disciplinaSelect" class="form-control">
                    <option value="">Todas</option>
                    @foreach($disciplinas as $disciplina)
                        <option value="{{ $disciplina }}" {{ request('disciplina') == $disciplina ? 'selected' : '' }}>
                            {{ $disciplina }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="statusSelect">Selecionar Status:</label>
                <select name="status" id="statusSelect" class="form-control">
                    <option value="">Todos os Status</option>
                    @foreach($tarefasStatus as $status => $count)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
        </form>
    </div>

    <!-- Lista de Tarefas Filtradas -->
    <div class="filtered-tasks mt-4">
        <h5>Tarefas Filtradas:</h5>
        <ul>
            @forelse($tarefasFiltradas as $tarefa)
                <li>{{ $tarefa->descricao }} - Disciplina: {{ $tarefa->disciplina }} - Status: {{ $tarefa->status }}</li>
            @empty
                <li>Nenhuma tarefa encontrada com os filtros selecionados.</li>
            @endforelse
        </ul>
    </div>

    <!-- Gráfico de Tarefas por Disciplina -->
    <div id="tarefasDisciplinaChart" style="width: 100%; height: 400px;"></div>

    <script>
        var tarefasDisciplinaData = @json($tarefasPorDisciplina);

        var chartDom = document.getElementById('tarefasDisciplinaChart');
        var myChart = echarts.init(chartDom);
        var option = {
            title: { text: 'Tarefas por Disciplina' },
            tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
            xAxis: {
                type: 'category',
                data: Object.keys(tarefasDisciplinaData),
                axisLabel: { interval: 0, rotate: 45 }
            },
            yAxis: { type: 'value' },
            series: [
                { name: 'Tarefas', type: 'bar', data: Object.values(tarefasDisciplinaData) }
            ]
        };

        option && myChart.setOption(option);
    </script>
</div>

@endsection
