@extends('layout')
@section('content')


<h3 class='text-center'>Indicadores</h3>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}" ></script>
<div class="row">
    <div class="col-lg-4">
        <canvas id="etapas" width="200" height="100"></canvas>
    </div>
    <div class="col-lg-4">
        <canvas id="etapas_perdidos" width="200" height="100"></canvas>
    </div>
    <div class="col-lg-4">
        <canvas id="etapas_ganados" width="200" height="100"></canvas>
    </div>
</div>


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
                label: 'Prospectos',
                data: [
                @foreach($prospectos_cant as $prospecto)
                    {{ $prospecto->cantidad }},
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