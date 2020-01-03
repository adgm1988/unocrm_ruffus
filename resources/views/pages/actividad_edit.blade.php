@extends('layout')
@section('content')


<h3 class='text-center'>{{ $actividad->prospecto->contacto }}</h3>
<!-- Trigger the modal with a button -->

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<form method="post" action="/actividad/{{ $actividad->id }}/{{ $origen }}" id="form">
	@csrf
	<div class="row">
		<div class="form-group col-md-12">
			<label for="prospecto">Prospecto:</label>
			<select class="custom-select" name="prospecto" disabled>
				<option value='{{ $actividad->prospecto->id }}'>{{ $actividad->prospecto->contacto }}</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="actividad">Actividad:</label>
			<select class="custom-select" name="actividad">
				@foreach($tipos as $tipo)
					<option {{ $actividad->_tipoactid === $tipo->id ? "selected" : "" }} value='{{ $tipo->id }}'>{{ $tipo->tipo }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="fecha">Fecha:</label>
			<input type="date" class="form-control" name="fecha" value="{{ $actividad->fecha}}">
		</div>
		<div class="form-group col-md-3">
			<label for="hora">Hora:</label>
			<select class="custom-select" name="hora">
				<option {{ $actividad->hora === '00:00' ? "selected" : "" }} value='00:00'>00:00 am</option>
				<option {{ $actividad->hora === '01:00' ? "selected" : "" }} value='01:00'>01:00 am</option>
				<option {{ $actividad->hora === '02:00' ? "selected" : "" }} value='02:00'>02:00 am</option>
				<option {{ $actividad->hora === '03:00' ? "selected" : "" }} value='03:00'>03:00 am</option>
				<option {{ $actividad->hora === '04:00' ? "selected" : "" }} value='04:00'>04:00 am</option>
				<option {{ $actividad->hora === '05:00' ? "selected" : "" }} value='05:00'>05:00 am</option>
				<option {{ $actividad->hora === '06:00' ? "selected" : "" }} value='06:00'>06:00 am</option>
				<option {{ $actividad->hora === '07:00' ? "selected" : "" }} value='07:00'>07:00 am</option>
				<option {{ $actividad->hora === '08:00' ? "selected" : "" }} value='08:00'>08:00 am</option>
				<option {{ $actividad->hora === '09:00' ? "selected" : "" }} value='09:00'>09:00 am</option>
				<option {{ $actividad->hora === '10:00' ? "selected" : "" }} value='10:00'>10:00 am</option>
				<option {{ $actividad->hora === '11:00' ? "selected" : "" }} value='11:00'>11:00 am</option>
				<option {{ $actividad->hora === '12:00' ? "selected" : "" }} value='12:00'>12:00 am</option>
				<option {{ $actividad->hora === '13:00' ? "selected" : "" }} value='13:00'>01:00 pm</option>
				<option {{ $actividad->hora === '14:00' ? "selected" : "" }} value='14:00'>02:00 pm</option>
				<option {{ $actividad->hora === '15:00' ? "selected" : "" }} value='15:00'>03:00 pm</option>
				<option {{ $actividad->hora === '16:00' ? "selected" : "" }} value='16:00'>04:00 pm</option>
				<option {{ $actividad->hora === '17:00' ? "selected" : "" }} value='17:00'>05:00 pm</option>
				<option {{ $actividad->hora === '18:00' ? "selected" : "" }} value='18:00'>06:00 pm</option>
				<option {{ $actividad->hora === '19:00' ? "selected" : "" }} value='19:00'>07:00 pm</option>
				<option {{ $actividad->hora === '20:00' ? "selected" : "" }} value='20:00'>08:00 pm</option>
				<option {{ $actividad->hora === '21:00' ? "selected" : "" }} value='21:00'>09:00 pm</option>
				<option {{ $actividad->hora === '22:00' ? "selected" : "" }} value='22:00'>10:00 pm</option>
				<option {{ $actividad->hora === '23:00' ? "selected" : "" }} value='23:00'>11:00 pm</option>

			</select>
		</div>
		<div class="form-group col-md-3">
			<label for="duracion">Duracion:</label>
			<select class="custom-select" name="duracion">
				<option {{ $actividad->duracion ==='00:30' ? "selected" : "" }} value='00:30'>00:30</option>
				<option {{ $actividad->duracion ==='00:45' ? "selected" : "" }} value='00:45'>00:45</option>
				<option {{ $actividad->duracion ==='01:00' ? "selected" : "" }} value='01:00'>01:00</option>
				<option {{ $actividad->duracion ==='01:30' ? "selected" : "" }} value='01:30'>01:30</option>
				<option {{ $actividad->duracion ==='02:00' ? "selected" : "" }} value='02:00'>02:00</option>
				<option {{ $actividad->duracion ==='02:30' ? "selected" : "" }} value='02:30'>02:30</option>
				<option {{ $actividad->duracion ==='03:00' ? "selected" : "" }} value='03:00'>03:00</option>
				<option {{ $actividad->duracion ==='03:30' ? "selected" : "" }} value='03:30'>03:30</option>
				<option {{ $actividad->duracion ==='04:00' ? "selected" : "" }} value='04:00'>04:00</option>
				<option {{ $actividad->duracion ==='05:00' ? "selected" : "" }} value='05:00'>05:00</option>
				<option {{ $actividad->duracion ==='06:00' ? "selected" : "" }} value='06:00'>06:00</option>
				<option {{ $actividad->duracion ==='07:00' ? "selected" : "" }} value='07:00'>07:00</option>
				<option {{ $actividad->duracion ==='08:00' ? "selected" : "" }} value='08:00'>08:00</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="descripcion">Descripcion:</label>
			<input type="text" class="form-control" name="descripcion" value="{{ $actividad->descripcion }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" {{ $actividad->realizada == 1 ? "checked" : "" }} name="realizada" id="realizada">
			  	<label class="form-check-label" for="realizada">
			    Realizada
			  	</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="resultado">Resultado:</label>
			<input type="text" class="form-control" name="resultado" value="{{ $actividad->resultado }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<button  class="btn btn-success" >Actualizar</button>
			<a href="/prospectos/{{ $actividad->prospecto->id }}"><button type="button" class="btn btn-secondary p-2 btn-sm">Cancelar</button></a>		
		</div>
	</div>


</form>

@endsection


