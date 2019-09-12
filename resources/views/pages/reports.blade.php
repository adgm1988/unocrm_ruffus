@extends('layout')
@section('content')

<h5>Reportes</h5>



<script src="{{ asset('vendor/chart.js/Chart.min.js') }}" ></script>

<canvas id="etapas" width="400" height="100"></canvas>
<script>
var ctx = document.getElementById('etapas');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        	@foreach($etapas as $etapa)
        		'{{ $etapa->etapa }}',
        	@endforeach
        ],
        datasets: [{
            label: 'Prospectos por etapa',
            data: [
            @foreach($etapas as $etapa)
                {{ $etapa->cuenta }},
            @endforeach
            ],
            backgroundColor: [
            	@foreach($etapas as $etapa)
        		  '{{ $etapa->color }}',
        	    @endforeach
            ],
            borderColor: [
            //vacio es sin borde
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<canvas id="etapas_perdidos" width="400" height="100"></canvas>
<script>
var ctx = document.getElementById('etapas_perdidos');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($etapas as $etapa)
                '{{ $etapa->etapa }}',
            @endforeach
        ],
        datasets: [{
            label: 'Perdidos por etapa',
            data: [
            @foreach($etapas as $etapa)
                {{ $etapa->cuentaperdidos }},
            @endforeach
            ],
            backgroundColor: [
                @foreach($etapas as $etapa)
                  '{{ $etapa->color }}',
                @endforeach
            ],
            borderColor: [
                //vacio es sin borde
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<canvas id="etapas_ganados" width="400" height="100"></canvas>
<script>
var ctx = document.getElementById('etapas_ganados');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($etapas as $etapa)
                '{{ $etapa->etapa }}',
            @endforeach
        ],
        datasets: [{
            label: 'Ganados por etapa',
            data: [
            @foreach($etapas as $etapa)
                {{ $etapa->cuentaclientes }},
            @endforeach
            ],
            backgroundColor: [
                @foreach($etapas as $etapa)
                  '{{ $etapa->color }}',
                @endforeach
            ],
            borderColor: [
                //vacio es sin borde
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>


<canvas id="tiempo_etapa" width="400" height="100"></canvas>
<script>
var ctx = document.getElementById('etapas_ganados');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($etapas as $etapa)
                '{{ $etapa->etapa }}',
            @endforeach
        ],
        datasets: [{
            label: 'Ganados por etapa',
            data: [
            @foreach($etapas as $etapa)
                {{ $etapa->cuentaclientes }},
            @endforeach
            ],
            backgroundColor: [
                @foreach($etapas as $etapa)
                  '{{ $etapa->color }}',
                @endforeach
            ],
            borderColor: [
                //vacio es sin borde
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<canvas id="tipoact" width="400" height="100"></canvas>
<script>
var ctx = document.getElementById('tipoact');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($tipoacts as $tipo)
                '{{ $tipo->tipo }}',
            @endforeach
        ],
        datasets: [{
            label: 'Actividades por tipo',
            data: [
                @foreach($tipoacts as $tipo)
                    {{ $tipo->cuenta }},
                @endforeach
            ],
            backgroundColor: [
                @foreach($tipoacts as $tipo)
                '{{ $tipo->color }}',
                @endforeach
            ],
            borderColor: [
                //vacio es sin borde
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>


@endsection
