@extends('layout')
@section('content')



<h3 class='text-center'>{{ $prospecto->empresa }}</h3>
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
						<div class="form-group col-md-3">
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
						<div class="form-group col-md-3">
							<label for="duracion">Duracion:</label>
							<select class="custom-select" name="duracion">
								<option selected value='00:30'>00:30</option>
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
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="descripcion">Descripcion:</label>
							<input type="text" class="form-control" name="descripcion">
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

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Contacto</th>
				<th>Teléfono</th>
				<th>Correo</th>
				<th>Procedencia</th>
				<th>Valor</th>
				<th>Estatus</th>
				
			</tr>
		</thead>
		<tr>	
			<td>{{ $prospecto->empresa }}</td>		
			<td>{{ $prospecto->contacto }}</td>		
			<td>{{ $prospecto->telefono }}</td>		
			<td>{{ $prospecto->correo }}</td>		
			<td>{{ $prospecto->procedencias->procedencia }}</td>		
			<td>${{ $prospecto->valor }}</td>		
			<td>{{ $prospecto->etapas->etapa }}</td>

		</tr>
	</table>
</div>



<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#">Actividades</a>
  </li>
  <!--<li class="nav-item">
    <a class="nav-link" href="#">Bitácora</a>
  </li>-->
</ul>


<div class="table-sm table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th><button type="button" class="btn btn-info p-1 btn-sm" data-toggle="modal" data-target="#modalactividad" id="open">Agregar</button></th>
				<th>Actividad</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Duración</th>
				<th>Descripción</th>
				<th>Resultado</th>
			</tr>
		</thead>
		@foreach($prospecto->actividades as $actividad)
		<tr>		
			<td nowrap>
				<a href="#"><i class="far fa-eye"></i></a>&nbsp;
				<a href="#" data-toggle="modal" data-target="#myModaledit" id="open"><i class="far fa-edit"></i></a>&nbsp;
				<a onclick="return confirm('¿Estas seguro de quere eliminar esta actividad?')" href="actividades/delete/{{ $actividad->id }}"><i class="far fa-trash-alt"></i></a>
			</td>	
			<td>{{ $actividad->tiposdeact->tipo }}</td>		
			<td nowrap>{{ $actividad->fecha }}</td>		
			<td>{{ $actividad->hora }}</td>		
			<td>{{ $actividad->duracion }}</td>		
			<td>{{ $actividad->descripcion }}</td>		
			<td>{{ $actividad->resultado }}</td>
		</tr>
		@endforeach
	</table>
</div>


@endsection