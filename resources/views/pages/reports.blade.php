@extends('layout')
@section('content')


<form action="/reportes/filtrar" method="post">
    @csrf
    <div class="row form-group">
        <label for="vendedor" class="col-md-1 col-form-label ">Vendedor:</label>
        <div class="form-group col-md-2">
            <select class="custom-select" name="vendedor" id="vendedor" onchange="checar_filtros()">
                <option value='0'>Todos</option>
                @foreach($vendedores as $vendedor)
                    <option value='{{ $vendedor->id }}'  {{ $vendedor->id == $user ? "selected" : "" }} >{{ $vendedor->name }}</option>
                @endforeach
            </select>
        </div>
        <label for="vendedor" class="col-md-1 col-form-label">Desde:</label>
        <div class="form-group col-md-3">
            <input type="date" class="form-control" name="desde" id="desde" value='{{ $desde }}' onchange="checar_filtros()">
        </div>
        <label for="vendedor" class="col-md-1 col-form-label">Hasta:</label>
        <div class="form-group col-md-3">
            <input type="date" class="form-control" name="hasta" id="hasta" value='{{ $hasta }}' onchange="checar_filtros()">
        </div>

        <div class="form-group col-md-1">
           <button id="boton_filtro" type="submit" class="btn btn-primary" disabled>Filtrar</button>
       </div> 
   </div>
</form>
<hr>

<h5>Cantidad (#)</h5>
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
                label: 'Clientes',
                data: [
                @foreach($clientes_cant as $cliente)
                    {{ $cliente->cantidad }},
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
                label: 'Perdidos',
                data: [
                @foreach($perdidos_cant as $perdido)
                    {{ $perdido->cantidad }},
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
<hr>
<h5>Monto ($)</h5>
<div class="row">
    <div class="col-lg-4">
        <canvas id="etapas_valor" width="200" height="100"></canvas>
    </div>
    <div class="col-lg-4">
        <canvas id="etapas_perdidos_valor" width="200" height="100"></canvas>
    </div>
    <div class="col-lg-4">
        <canvas id="etapas_ganados_valor" width="200" height="100"></canvas>
    </div>
</div>


<script>
    var ctx = document.getElementById('etapas_valor');
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
                @foreach($prospectos_val as $prospecto)
                    {{ $prospecto->suma }},
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

<script>
    var ctx = document.getElementById('etapas_perdidos_valor');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($etapas as $etapa)
                    '{{ $etapa->etapa }}',
                @endforeach
            ],
            datasets: [{
                label: 'Clientes',
                data: [
                @foreach($clientes_val as $cliente)
                    {{ $cliente->suma }},
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

<script>
    var ctx = document.getElementById('etapas_ganados_valor');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($etapas as $etapa)
                    '{{ $etapa->etapa }}',
                @endforeach
            ],
            datasets: [{
                label: 'Perdidos',
                data: [
                @foreach($perdidos_val as $perdido)
                    {{ $perdido->suma }},
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
</script>


<!--
<h5>Otros</h5>
<canvas id="tiempo_etapa" width="400" height="100"></canvas>
<script>
    var ctx = document.getElementById('tiempo_etapa');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($etapas as $etapa)
                    '{{ $etapa->etapa }}',
                @endforeach
            ],
            datasets: [{
                label: 'Tiempo por etapa',
                data: [
                @foreach($etapas as $etapa)
                    {{ $etapa->diasetapa }},
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
            },
            legend: {
              labels: {
                  boxWidth: 0
              }
          }
        }
    });
</script>

-->
@endsection



<script>
    window.onload = function(){
        checar_filtros();
    }
    
    var checar_filtros = function(){

        var desde = document.getElementById("desde").value;
        var hasta = document.getElementById("hasta").value;
        if(desde!='' && hasta!=''){
            document.getElementById('boton_filtro').disabled = false;
        }else{
            document.getElementById('boton_filtro').disabled = true;
        }
    }
        
</script>