@extends('layout')
@section('content')


<h3 class='text-center'>Indicadores</h3>

@if(auth::user()->vendedor  != 1)
<form action="/indicadoresfiltro" method="post">
    @csrf
    <select name="vendedorid" id="vendedorid">
            <option value="0" selected></option>
        @foreach ($vendedores as $vendedor)
            <option value="{{$vendedor->id}}">{{$vendedor->name}}</option>
        @endforeach
    </select>
    <input type="submit" value="Filtrar">
</form>
@endif
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}" ></script>

<div class="row">
    <div class="col-lg-12">
        <canvas id="semanal" width="200" height="40"></canvas>
    </div>
    <div class="col-lg-12">
        <canvas id="mensual" width="200" height="40"></canvas>
    </div>
    <div class="col-lg-12">
        <canvas id="trimestral" width="200" height="40"></canvas>
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
                    '#20c997',
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
          },
          tooltips: {
           mode: 'label',
           label: 'mylabel',
           callbacks: {
               label: function(tooltipItem, data) {
                   return "$"+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
               }
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
                    '#20c997',
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
          },
          tooltips: {
           mode: 'label',
           label: 'mylabel',
           callbacks: {
               label: function(tooltipItem, data) {
                   return "$"+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
               }
           }
        }
        }
    });
</script>

<script>
    var ctx = document.getElementById('trimestral');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($ventatrimestral as $mes)
                    '{{ $mes->mes }}',
                @endforeach
            ],
            datasets: [{
                label: 'Venta trimestral',
                data: [
                @foreach($ventatrimestral as $mes)
                    '{{ $mes->suma }}',
                @endforeach
                ],
                backgroundColor: [
                    @foreach($ventatrimestral as $mes)
                    '#20c997',
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
          },
          tooltips: {
           mode: 'label',
           label: 'mylabel',
           callbacks: {
               label: function(tooltipItem, data) {
                   return "$"+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
               }
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