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
    <br>
    <br>

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

    <!-- Gráfico de Barras -->
    <div id="tarefasStatusChart" style="width: 100%; height: 400px;"></div>

    <script>
        var chartDom = document.getElementById('tarefasStatusChart');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            title: {
                text: 'Status das Tarefas',
                left: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            xAxis: {
                type: 'category',
                data: [
                    @foreach($tarefasStatus as $status => $total)
                        '{{ $status }}',
                    @endforeach
                ],
                axisLabel: {
                    interval: 0,
                    rotate: 45
                }
            },
            yAxis: {
                type: 'value',
                minInterval: 1
            },
            series: [
                {
                    name: 'Tarefas',
                    type: 'bar',
                    data: [
                        @foreach($tarefasStatus as $total)
                            {{ $total }},
                        @endforeach
                    ],
                    itemStyle: {
                        color: function(params) {
                            // Paleta de cores personalizada para as barras
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
@endsection
