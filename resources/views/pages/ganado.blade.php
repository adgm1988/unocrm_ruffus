@extends('layout')
@section('content')


@if ($errors->any())
<div class="alert alert-danger">
	<strong>Revisa los datos ingreasados<br><br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<h4>{{ $prospecto->empresa }}</h4>
<h5>{{ $prospecto->contacto }}</h5>
<form method="post" action="/ganado/{{ $prospecto->id}}" id="form">
	@csrf

	<div class="row">
		<div class="form-group col-12">
			<label for="empresa">Valor de venta:</label>
			<input type="float" class="form-control" name="valor" >
		</div>
		<div class="form-group col-12">
			<label for="orden">Notas:</label>
			<textarea name="notas" class="md-textarea form-control" rows="3"></textarea>
		</div>
		<input type="hidden" name="etapa_anterior_id" value="{{ $prospecto->etapas->id }}">
	</div>
	
	<div class="row">
		<div class="form-group col-md-6">
			<button class="btn btn-success" >Guardar</button>
			<a href="/prospectos/{{ $prospecto->id }}"><button type="button" class="btn btn-secondary" >Cancelar</button></a>
		</div>
	</div>
</form>

@endsection