@extends('layout')
@section('content')



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


<form method="post" action="/tipoacts/{{ $tipo->id}}" id="form">
	@csrf

	<div class="row">
		<div class="form-group col-md-6">
			<label for="empresa">Tipo de actividad:</label>
			<input type="text" class="form-control" name="tipo" value="{{ $tipo->tipo }}">
		</div>
		<div class="form-group col-md-6">
			<label for="orden">Orden:</label>
			<input type="text" class="form-control" name="orden"  value="{{ $tipo->orden }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="color">Color activa:</label>
			<input type="color" class="form-control" name="color"  value="{{ $tipo->color }}">
		</div>
		<div class="form-group col-md-6">
			<label for="color_realizada">Color realizada:</label>
			<input type="color" class="form-control" name="color_realizada"  value="{{ $tipo->color_realizada }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<button  class="btn btn-success" >Actualizar</button>
			<a href="/tipoacts"><button type="button" class="btn btn-secondary" >Cancelar</button></a>
		</div>
	</div>

</form>

@endsection