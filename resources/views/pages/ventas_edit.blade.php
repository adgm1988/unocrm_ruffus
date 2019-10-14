@extends('layout')
@section('content')



<h3 class='text-center'>{{ $venta->prospecto->empresa }}</h3>
<h5 class='text-center'>{{ $venta->prospecto->estatus }}</h5>
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

<form method="post" action="/ventas/{{ $venta->id}}" id="form">
	@csrf
	
	<div class="row">
		<div class="form-group col-md-6">
			<label for="prospecto">Prospecto:</label>
			<input type="text" class="form-control" name="fecha"  disabled value="{{ $venta->prospecto->empresa }}">
		</div>
		<div class="form-group col-md-6">
			<label for="prospecto">Contacto:</label>
			<input type="text" class="form-control" name="fecha" disabled value="{{ $venta->prospecto->contacto }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="fecha">Fecha:</label>
			<input type="date" class="form-control" name="fecha" value="{{ $venta->fecha }}">
		</div>
		<div class="form-group col-md-6">
			<label for="fecha">Monto:</label>
			<input type="number" class="form-control" name="monto" value="{{ $venta->monto }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="detalle">Descripcion:</label>
			<textarea class="form-control" rows="5" id="detalle" name="detalle">{{ $venta->detalle }}</textarea>
		</div>
	</div>




<div class="row">
	<div class="form-group col-md-12">
		<button type="submit" class="btn btn-primary">Actualizar</button>
		<a href="/ventas"><button type="button" class="btn btn-secondary p-2 btn-sm">Cancelar</button></a>
	</div>

</div>



</form>








@endsection