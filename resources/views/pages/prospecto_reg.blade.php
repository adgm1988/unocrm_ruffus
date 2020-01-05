@extends('layout')
@section('content')


<!-- Trigger the modal with a button -->

@if ($errors->any())
<div class="alert alert-danger">
	<strong>Whoops!</strong> There were some problems with your input.<br><br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<form method="post" action="{{url('/prospecto/'.$prospecto->id.'/actividad')}}" id="form">
	@csrf

	<!-- Modal agregar -->
	<div class="modal" tabindex="-1" role="dialog" id="modalactividad">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar actividad</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="form-group col-md-12">
							<label for="actividad">Actividad:</label>
							<select class="custom-select" name="actividad">
								@foreach($tipos as $tipo)
								<option value='{{ $tipo->id }}'>{{ $tipo->tipo }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="fecha">Fecha:</label>
							<input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}">
						</div>
						<div class="form-group col-md-6">
							<label for="hora">Hora:</label>
							<select class="custom-select" name="hora">
								<option value='00:00'>00:00 am</option>
								<option value='01:00'>01:00 am</option>
								<option value='02:00'>02:00 am</option>
								<option value='03:00'>03:00 am</option>
								<option value='04:00'>04:00 am</option>
								<option value='05:00'>05:00 am</option>
								<option value='06:00'>06:00 am</option>
								<option value='07:00'>07:00 am</option>
								<option value='08:00'>08:00 am</option>
								<option selected value='09:00'>09:00 am</option>
								<option value='10:00'>10:00 am</option>
								<option value='11:00'>11:00 am</option>
								<option value='12:00'>12:00 am</option>
								<option value='13:00'>01:00 pm</option>
								<option value='14:00'>02:00 pm</option>
								<option value='15:00'>03:00 pm</option>
								<option value='16:00'>04:00 pm</option>
								<option value='17:00'>05:00 pm</option>
								<option value='18:00'>06:00 pm</option>
								<option value='19:00'>07:00 pm</option>
								<option value='20:00'>08:00 pm</option>
								<option value='21:00'>09:00 pm</option>
								<option value='22:00'>10:00 pm</option>
								<option value='23:00'>11:00 pm</option>

							</select>
						</div>
						<!--
						<div class="form-group col-md-3">
							<label for="duracion">Duracion:</label>
							<select class="custom-select" name="duracion">
								<option selected value='00:20'>00:20</option>
								<option value='00:45'>00:45</option>
								<option value='01:00'>01:00</option>
								<option value='01:30'>01:30</option>
								<option value='02:00'>02:00</option>
								<option value='02:30'>02:30</option>
								<option value='03:00'>03:00</option>
								<option value='03:30'>03:30</option>
								<option value='04:00'>04:00</option>
								<option value='05:00'>05:00</option>
								<option value='06:00'>06:00</option>
								<option value='07:00'>07:00</option>
								<option value='08:00'>08:00</option>
							</select>
						</div>
						-->
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="descripcion">Descripcion:</label>
							<input type="text" class="form-control" name="descripcion">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" name="realizada" id="realizada">
							  	<label class="form-check-label" for="realizada">
							    Realizada
							  	</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="resultado">Resultado:</label>
							<input type="text" class="form-control" name="resultado">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button  class="btn btn-success" >Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>


<!--Modal cambio de estatus--->
<form method="post" action="{{url('/prospecto/'.$prospecto->id.'/etapa')}}" id="form">
	@csrf

	<!-- Modal agregar -->
	<div class="modal" tabindex="-1" role="dialog" id="modalestatus">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Estatus</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="form-group col-md-12">
							<label for="actividad">Estatus:</label>
							<select class="custom-select" name="etapa">
								@foreach($etapas as $etapa)
								<option {{ $etapa->id === $prospecto->etapas->id ? "selected" : "" }} value='{{ $etapa->id }}'>{{ $etapa->etapa }}</option>
								@endforeach
							</select>
							<input type="hidden" name="etapa_anterior_id" value="{{ $prospecto->etapas->id }}">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button  class="btn btn-success" >Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>


<form method="post" action="{{url('/prospecto/'.$prospecto->id.'/venta')}}" id="form">
	@csrf

	<!-- Modal agregar -->
	<div class="modal" tabindex="-1" role="dialog" id="modalventa">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar venta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					
					<div class="row">
						<div class="form-group col-md-6">
							<label for="fecha">Fecha:</label>
							<input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}">
						</div>
						<div class="form-group col-md-6">
							<label for="fecha">Monto:</label>
							<input type="number" class="form-control" name="monto" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="detalle">Descripcion:</label>
							<textarea class="form-control" rows="5" id="detalle" name="detalle"></textarea>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button  class="btn btn-success" >Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>


<div class="card mb-3">
	<h5 class="card-header"> 
		<i style="font-size:10px; color:{{ $prospecto->semaforo }}" class="fas fa-circle"></i> 
		{{ $prospecto->contacto }}
		@if($prospecto->estatus!='prospecto')
			<span style="color:gray;">({{ ucfirst($prospecto->estatus) }})</span>
		@endif 
		
		<span style="float:right;">
			<a href="/prospectos/{{ $prospecto->id }}/form">
				<button type="button" class="btn btn-info p-1 btn-sm mr-3">Editar prospecto</button>
			</a>
		</span>
	</h5>
	<div class="card-body">
		<p class="card-text">
			<div class="container">
				<div class="row mb-3">
					<div class="col-md-4"><span class="font-weight-bold">Servicio:</span> {{ $prospecto->industrias->industria }} </div>
					<div class="col-md-4" ><span class="font-weight-bold">Etapa: </span>
								
							<button  type="button" class="ml-2 p-2 btn-sm" style="color:black; border-radius: 13px; font-weight:bold; text-align:center; height:30px; border:1px solid black; padding:3px 15px 3px 15px !important; background-color: {{ $prospecto->etapas->color }}"  data-toggle="modal" data-target="#modalestatus" id="open">
								{{ $prospecto->etapas->etapa }} <i class="ml-2 fas fa-sync-alt"></i>	
							</button>

					</div>
					<div class="col-md-4"><span class="font-weight-bold">Procedencia:</span> {{ $prospecto->procedencias->procedencia }}</div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="font-weight-bold">Telefono:</span> {{ $prospecto->telefono }}</div>
					<div class="col-md-4"><span class="font-weight-bold">Correo: </span>{{ $prospecto->correo }}</div>
					<div class="col-md-4"><span class="font-weight-bold">Valor: </span>$ {{ number_format($prospecto->valor,2,".",",") }}</div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="font-weight-bold">Instagram:</span> {{ $prospecto->instagram }}</div>
					<div class="col-md-4"><span class="font-weight-bold">Nombre mascota: </span>{{ $prospecto->dogname }}</div>
					<div class="col-md-4"><span class="font-weight-bold">Tamaño mascota: </span>{{ $prospecto->dogsize }}</div>
				</div>
			</p>
		</div>
	</div>
</div>


<nav>

	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected=true>Actividad</a>

		<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected='false'>Bitácora</a>

				
		<a class="nav-item nav-link" id="nav-ventas-tab" data-toggle="tab" href="#nav-ventas" role="tab" aria-controls="nav-ventas" aria-selected='false'>Ventas</a>
		
	</div>
</nav>

<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		<div class="table-sm table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th><button type="button" class="btn btn-info p-1 btn-sm" data-toggle="modal" data-target="#modalactividad" id="open">Agregar</button></th>
						<th>Actividad</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Descripción</th>
						<th>Realizada</th>
						<th>Resultado</th>
						<th>Creación</th>
						<th>Edición</th>
					</tr>
				</thead>
				@foreach($prospecto->actividades as $actividad)
				<tr>		
					<td nowrap>
						<a href="/actividad/{{ $actividad->id }}/form/prospecto"><i class="far fa-edit"></i></a>&nbsp;
						@if(auth::user()->admin ==1 || auth::user()->consultor ==1)
						<a onclick="return confirm('¿Estas seguro de querer eliminar esta actividad?')" href="actividades/delete/{{ $actividad->id }}/prospecto"><i class="far fa-trash-alt"></i></a>
						@endif
					</td>	
					<td style="color:{{ $actividad->semaforo }}">{{ $actividad->tiposdeact->tipo }}</td>		
					<td nowrap>{{ $actividad->fecha }}</td>		
					<td>{{ $actividad->hora }}</td>			
					<td>{{ $actividad->descripcion }}</td>		
					<td>
						@if($actividad->realizada)
						&#10004
						@else
						&#x274C
						@endif
					</td>
					<td>{{ $actividad->resultado }}</td>
					<td>{{ $actividad->creadopor->name}} ({{$actividad->created_at}})</td>
					<td>{{ $actividad->editadopor->name }} ({{$actividad->edited_at}})</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
		<div class="table-sm table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Fecha</th>
						<!--<th>Etapa anterior</th>-->
						<th>Etapa</th>
						<th>Días</th>
						<th>Nota</th>
						<th>Usuario</th>
					</tr>
				</thead>
				@foreach($prospecto->bitacoras as $bitacora)
				<tr>		
					<td nowrap>{{ $bitacora->fecha }}</td>
					<!--<td>{{ $bitacora->etapa_anterior ? $bitacora->etapa_anterior->etapa : '-' }}</td>-->
					<td>{{ $bitacora->etapa->etapa }}</td>
					<td>{{ $bitacora->dias }}</td>
					<td>{{ $bitacora->nota }}</td>
					<td>{{ $bitacora->user->name }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<div class="tab-pane fade" id="nav-ventas" role="tabpanel" aria-labelledby="nav-ventas-tab">
		<div class="table-sm table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>
							@if($prospecto->estatus=='cliente')
								<button type="button" class="btn btn-info p-1 btn-sm" data-toggle="modal" data-target="#modalventa" id="open">Agregar</button>
							@endif
						</th>
						<th>Fecha</th>
						<th>Monto</th>
						<th>Detalle</th>
					</tr>
				</thead>
				@foreach($prospecto->ventas as $venta)
				<tr>
					<td nowrap>
						<a href="/venta/{{ $venta->id }}/form/prospecto"><i class="far fa-edit"></i></a>&nbsp;
						<a onclick="return confirm('¿Estas seguro de querer eliminar esta venta?')" href="ventas/delete/{{ $venta->id }}/prospecto"><i class="far fa-trash-alt"></i></a>
					</td>			
					<td nowrap>{{ $venta->fecha }}</td>
					<td>${{ number_format($venta->monto,2,".",",") }}</td>
					<td>{{ $venta->detalle }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection