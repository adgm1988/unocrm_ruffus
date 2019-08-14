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

<form method="post" action="/industria/{{ $industria->id}}" id="form">
	@csrf
	
	<div class="row">
		<div class="form-group col-md-6">
			<label for="industria">Industria:</label>
			<input type="text" class="form-control" name="industria" value="{{ $industria->industria }}">
		</div>
		<div class="form-group col-md-6">
			<label for="orden">Orden:</label>
			<input type="text" class="form-control" name="orden" value="{{ $industria->orden }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<button class="btn btn-success" >Actualizar</button>
			<a href="/industrias"><button type="button" class="btn btn-secondary p-2 btn-sm">Cancelar</button></a>
		</div>
	</div>
</form>
@endsection