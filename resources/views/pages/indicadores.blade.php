@extends('layout')
@section('content')


<h3 class='text-center'>Indicadores</h3>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}" ></script>
<div class="row">
    <div class="col-lg-12">
        <canvas id="semanal" width="200" height="50"></canvas>
    </div>
    <div class="col-lg-12">
        <canvas id="mensual" width="200" height="50"></canvas>
    </div>
    
</div>


<script>
    var ctx = document.getElementById('semanal');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
            	@foreach($ventasemanal as $semana)
            		'{{ $semana->semana }}',
            	@endforeach
            ],
            datasets: [{
                label: 'Venta Semanal',
                data: [
                @foreach($ventasemanal as $semana)
                    '{{ $semana->suma }}',
                @endforeach
                ],
                backgroundColor: [
                	@foreach($ventasemanal as $semana)
                    '#36e252',
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
            },
            legend: {
              labels: {
                  boxWidth: 0
              }
          }
        }
    });
</script>

<script>
    var ctx = document.getElementById('mensual');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($ventamensual as $mes)
                    '{{ $mes->mes }}',
                @endforeach
            ],
            datasets: [{
                label: 'Venta mensual',
                data: [
                @foreach($ventamensual as $mes)
                    '{{ $mes->suma }}',
                @endforeach
                ],
                backgroundColor: [
                    @foreach($ventamensual as $mes)
                    '#36e252',
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
            },
            legend: {
              labels: {
                  boxWidth: 0
              }
          }
        }
    });
</script>


@endsection



<script>
    window.onload = function(){
        checar_filtros();
    }
    
    var checar_filtros = function(){

    }
        
</script>