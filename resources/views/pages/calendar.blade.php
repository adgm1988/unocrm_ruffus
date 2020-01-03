@extends('layout')
@section('content')

<button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#modalactividad" id="open">Agregar actividad</button>
<form method="post" action="{{url('actividadescal')}}" id="form">
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
							

							<label for="prospecto">Prospecto:</label>
							<select class="custom-select" name="prospecto">
								@foreach($prospectos as $prospecto)
								<option value='{{ $prospecto->id }}'>{{ $prospecto->contacto }}</option>
								@endforeach
							</select>
						</div>
					</div>
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
							<input type="date" class="form-control" name="fecha">
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
								<option value='2:00'>09:00 pm</option>
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
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="realizada" id="realizada">
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



    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}

@endsection