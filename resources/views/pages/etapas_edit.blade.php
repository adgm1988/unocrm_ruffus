@extends('layout')
@section('content')



<h3 class='text-center'>{{ $etapa->etapa }}</h3>
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

<form method="post" action="/etapas/{{ $etapa->id}}" id="form">

	@csrf
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>

	<div class="row">
		<div class="form-group col-md-12">
			<label for="empresa">Etapa:</label>
			<input type="text" class="form-control" name="etapa" value="{{ $etapa->etapa }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="telefono">Orden:</label>
			<input type="text" class="form-control" name="orden" value="{{ $etapa->orden }}">
		</div>
		<div class="form-group col-md-6">
			<label for="correo">Color:</label>
			<input type="color" class="form-control" name="color" value="{{ $etapa->color }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-12">
			<button type="submit" class="btn btn-success">Actualizar</button>
			<a href="/etapas"><button type="button" class="btn btn-secondary p-2 btn-sm">Cancelar</button></a>
		</div>
	</div>
</form>
@endsection