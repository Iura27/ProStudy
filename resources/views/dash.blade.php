@extends('layouts.app')

@section('content')
<div class="container-fluid dashboard">
    <div class="content-header">
        <h1>Dashboard</h1>
    </div>
    <br><br>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.3/dist/echarts.min.js"></script>
    </head>

    <script>
        var tarefasStatusData = @json($tarefasStatus);
    </script>

    <!-- Row dos Cards -->
    <div class="row mb-4">
        <!-- Card Tarefas -->
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-inbox icon-home bg-primary text-light"></i>
                        </div>
                        <div class="col-8">
                            <p style="font-size: 20px">Tarefas</p>
                            <h5>{{ $tarefasFiltradas->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Horários -->
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

        <!-- Card Planos -->
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

    <!-- Filtro por Disciplina e Status -->
    <div class="mb-4">
        <form method="GET" action="{{ route('dash') }}">
            <div class="d-flex align-items-end">
                <!-- Selecionar Disciplina -->
                <div class="me-2">
                    <label for="disciplinaSelect">Selecionar Disciplina:</label>
                    <select name="disciplina" id="disciplinaSelect" class="form-control" style="width: 150px;">
                        <option value="">Todas</option>
                        @foreach($disciplinas as $disciplina)
                            <option value="{{ $disciplina }}" {{ request('disciplina') == $disciplina ? 'selected' : '' }}>
                                {{ $disciplina }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Selecionar Status -->
                <div class="me-2">
                    <label for="statusSelect">Selecionar Status:</label>
                    <select name="status" id="statusSelect" class="form-control" style="width: 300px;">
                        <option value="">Todos os Status</option>
                        @foreach($tarefasStatus as $status => $count)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botão de Filtrar -->
                <button type="submit" class="btn btn-primary btn-sm" style="top: 10px">Filtrar</button>
            </div>
        </form>
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
                data: Object.keys(tarefasStatusData),
                axisLabel: { interval: 0, rotate: 45 }
            },
            yAxis: { type: 'value', minInterval: 1 },
            series: [
                {
                    name: 'Tarefas',
                    type: 'bar',
                    data: Object.values(tarefasStatusData),
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
</div>






<!-- Div para exibir o gráfico de horários -->
<div id="graficoHorarios" style="width: 100%; height: 400px; margin-top: 150px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        const chartDom = document.getElementById('graficoHorarios');
        const myChart = echarts.init(chartDom);




        // Dados de meses
        const meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        // Preparação dos dados para o gráfico
        const horariosAgrupados = @json($horariosAgrupados);

        // Organizar dados em um formato para ECharts
        const statusMap = {};  // Armazena status distintos
        const seriesData = {}; // Armazena dados para cada série

        horariosAgrupados.forEach(item => {
            const mesIndex = item.month - 1;  // Para alinhar com o array de meses
            const status = item.status;

            if (!statusMap[status]) {
                statusMap[status] = true;  // Guardar o status único
            }

            if (!seriesData[status]) {
                seriesData[status] = Array(12).fill(0);  // Inicializar a série para o status
            }
            seriesData[status][mesIndex] = item.total;
        });

        // Configuração das séries para o gráfico com base nos status únicos
        const series = Object.keys(seriesData).map(status => ({
            name: status,
            type: 'bar',
            stack: 'total',
            label: { show: true },
            emphasis: { focus: 'series' },
            data: seriesData[status]
        }));

        // Configurações do gráfico
        const option = {
        title: {
            text: 'Horários por status e meses ',
            left: 'center',
        },

            tooltip: {
                trigger: 'axis',
                axisPointer: { type: 'shadow' }
            },
            legend: {
                data: Object.keys(statusMap) , // Cria legendas para cada status único
                top: '25 px'
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: { type: 'value' },
            yAxis: { type: 'category', data: meses },
            series: series
        };

        // Configurar e renderizar o gráfico
        myChart.setOption(option);
    });
</script>


<!-- Div para exibir o gráfico de evolução dos planos -->
<div id="evolucaoPlanosChart" style="width: 100%; height: 400px; margin-top: 50px; margin-top:150px;"></div>

<script>
    // Dados para o gráfico
    var planosAgrupados = @json($planosAgrupados);

    // Configuração do gráfico de linhas horizontal
    var option = {
        title: {
            text: 'Evolução dos Planos de Estudo Em andamento e Concluídas ',
            left: 'center'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line' // Destacar a linha ao passar o mouse
            }
        },
        legend: {
            data: ['Em andamento', 'Concluídas '],
            top: '10%'
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            data: Object.keys(planosAgrupados),
            name: 'Mês',
            axisLabel: {
                rotate: 45, // Rotacionar os labels para facilitar a leitura
            }
        },
        yAxis: {
            type: 'value',
            name: 'Número de Planos'
        },
        series: [
            {
                name: 'Em andamento',
                type: 'line',
                smooth: true, // Linha suave para mostrar crescimento/descrecimento
                data: Object.values(planosAgrupados).map(d => d['Em andamento'] || 0),
                lineStyle: {
                    color: '#5470C6'
                },
                areaStyle: {
                    opacity: 0.2,
                    color: '#5470C6' // Adiciona uma área sombreada
                },
                symbol: 'circle', // Marca o ponto de cada valor
                symbolSize: 8
            },
            {
                name: 'Concluídas ',
                type: 'line',
                smooth: true,
                data: Object.values(planosAgrupados).map(d => d['Concluídas'] || 0),
                lineStyle: {
                    color: '#91CC75'
                },
                areaStyle: {
                    opacity: 0.2,
                    color: '#91CC75'
                },
                symbol: 'circle',
                symbolSize: 8
            }
        ]
    };

    // Inicializar e renderizar o gráfico
    var chartDom = document.getElementById('evolucaoPlanosChart');
    var myChart = echarts.init(chartDom);
    myChart.setOption(option);
</script>



@endsection
