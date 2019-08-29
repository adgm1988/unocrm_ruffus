@extends('layout')
@section('content')

<!-- Modal cierre -->

<div class="modal" tabindex="-1" role="dialog" id="modalcierre">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="alert alert-danger" style="display:none"></div>
			<div class="modal-header">

				<h5 class="modal-title" id="nombre_prospecto">Resultado </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-6 text-center">
						<a id="perdido" href="">
							<button style="box-shadow: 2px 2px 2px grey; color:white; background-color:#ff0000;" class="btn btn-lg p3" >Perdido</button>
						</a>
					</div>
					<div class="col-6 text-center">
						<a id="ganado" href="">
							<button style="box-shadow: 2px 2px 2px grey; color:white; background-color:#45bd17;" class="btn btn-lg p3" >Ganado</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mb-3">
	<div class="col-md-4">
		<input onkeyup="filtrar()" id="filtro" type="text" class="form-control form-control-sm" placeholder="Nombre de empresa o contacto..." name="valor">
	</div>
</div>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			
			<tr>
				@foreach($etapas as $key=>$etapa)
					<th class='text-center'>
						<div>{{ $etapa->etapa }} <span style="font-size:10px; color:gray;"> ({{ $etapa->cuenta }})</span></div>
						<div style="font-size:12px; color: {{ $etapa->color }}">${{ number_format($etapa->suma,0) }}</div>
					</th>
				@endforeach
			</tr>
			
		</thead>
		<tr style="background-color:lightgray;">			
				@foreach($etapas as $etapa)
				<td style="padding:3px; min-width:200px; max-width:200px; ">
					@foreach($prospectos as $prospecto)
					@if($prospecto->etapas->etapa == $etapa->etapa)				
					
					<div class="tarjeta" style="width:98%; box-shadow: 2px 2px #888888; border: 1px solid gray; background-color:{{ $prospecto->indicador }}; border-bottom:5px solid {{ $etapa->color }} ; border-radius:4px; padding:5px; margin:auto; margin-bottom:5px; ">
						<div>
							<div style="padding-right:5px; overflow:hidden;">
								<span class="empresa" style="font-size:12px; font-weight:bold; margin-left:5px; white-space:nowrap; "><i style="font-size:10px; color:{{ $prospecto->semaforo }}" class="fas fa-circle"></i> {{ $prospecto->empresa }}</span> 
							</div>						
							<br>
							<hr style="margin:2px;">
							<span class="contacto" style="font-size:10px; font-weight:bold; float:left;">{{ $prospecto->contacto }}</span> 
							<span style="color:gray; font-size: 9px; float:right;">${{ $prospecto->valor }}</span>
						</div>
						<div style="clear:both"></div>
						
						<hr style="margin:4px;">
						<div style="width:100%">
							<a style="text-decoration:none; color:black;" href="/prospectos/{{ $prospecto->id }}">
								<button style="box-shadow: 2px 2px 2px grey; color:#eaeaea; background-color:#343a40; float:left; width:49%" class="btn btn-sm p-0"><i class="far fa-eye"></i></button>
							</a>
							<button style="box-shadow: 2px 2px 2px grey; color:#eaeaea; background-color:#343a40; float:right; width:49%" class="btn btn-sm p-0" data-toggle="modal" data-target="#modalcierre" id="open" onclick="llenar_modal({{ $prospecto->id }},'{{ $prospecto->empresa }}')"><i class="far fa-handshake" style="font-weight:bold;" ></i></button>
						</div>
						<div style="clear:both"></div>
					</div>					
					@endif
					@endforeach
				</td>

				@endforeach

						
		</tr>
	</table>
</div>

<script>
	var llenar_modal = function(id, prospecto){
		var nombre_prospecto = document.getElementById('nombre_prospecto');
		nombre_prospecto.innerHTML = prospecto;
		var perdido =  document.getElementById('perdido');
		var ganado =  document.getElementById('ganado');
		perdido.href = "/perdido/"+id;
		ganado.href = "/ganado/"+id;
	}

	var filtrar = function(){
		var valor = document.getElementById('filtro').value.toUpperCase();
		var tarjetas = document.getElementsByClassName('tarjeta');
		for(var i=0; i<tarjetas.length; i++){
			var empresa = tarjetas[i].getElementsByClassName('empresa')[0].textContent.toUpperCase();
			var contacto = tarjetas[i].getElementsByClassName('contacto')[0].textContent.toUpperCase();
			var filtro = empresa+contacto;

			if(filtro.includes(valor)){
				tarjetas[i].style.display='block';
			}else{
				tarjetas[i].style.display='none';
			}
		}

	}


</script>

@endsection