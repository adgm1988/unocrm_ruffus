@extends('layout')
@section('content')



<h3 class='text-center'>{{ $prospecto->empresa }}</h3>
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

<form method="post" action="/prospectos/{{ $prospecto->id}}" id="form">
	@csrf
	<div class="row">
		<div class="form-group col-md-12">
			<label for="empresa">Empresa:</label>
			<input type="text" class="form-control" name="empresa" value="{{ $prospecto->empresa }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="contacto">Contacto:</label>
			<input type="text" class="form-control" name="contacto" value="{{ $prospecto->contacto }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="telefono">Teléfono:</label>
			<input type="text" class="form-control" name="telefono" value="{{ $prospecto->telefono }}">
		</div>
		<div class="form-group col-md-6">
			<label for="correo">Correo:</label>
			<input type="text" class="form-control" name="correo" value="{{ $prospecto->correo }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="procedencia">Procedencia:</label>
			<select class="custom-select" name="procedencia">
				@foreach($procedencias as $procedencia)
				<option {{ $procedencia->id === $prospecto->procedencia ? "selected" : "" }} value='{{ $procedencia->id }}'>{{ $procedencia->procedencia }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-md-6">
			<label for="procedencia">Industria:</label>
			<select class="custom-select" name="industria">
				@foreach($industrias as $industria)
				<option {{ $industria->id === $prospecto->industria ? "selected" : "" }} value='{{ $industria->id }}'>{{ $industria->industria }}</option>
				@endforeach
			</select>
		</div>

	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="procedencia">Etapa:</label>
			<select class="custom-select" name="etapa" disabled>
				@foreach($etapas as $etapa)
				<option {{ $etapa->id === $prospecto->etapa ? "selected" : "" }} value='{{ $etapa->id }}'>{{ $etapa->etapa }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-md-6">
			<label for="valor">Valor de oportunidad:</label>
			<input type="number" step=".01" class="form-control" name="valor" value="{{ $prospecto->valor }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="/prospectos/{{ $prospecto->id }}"><button type="button" class="btn btn-secondary p-2 btn-sm">Cancelar</button></a>
   		</div>
   		
	</div>
	
	

</form>








@endsection