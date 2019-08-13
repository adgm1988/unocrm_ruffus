@extends('layout')
@section('content')



<h3 class='text-center'>Tipos de actividad</h3>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modaltipoact" id="open">Agregar tipo</button>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Tipo</th>
				<th>Orden</th>
				<th>Color calendario</th>
				<th>Color realizada</th>
			</tr>
		</thead>
		@foreach($tipos as $tipo)
		<tr>
			<td>
				<a href="/tipoacts/{{ $tipo->id }}/form"><i class="far fa-edit"></i></a>&nbsp;
				<a href="/tipos/delete/{{ $tipo->id }}"><i class="far fa-trash-alt"></i></a>
			</td>
			<td>{{ $tipo->tipo }}</td>
			<td>{{ $tipo->orden }}</td>
			<td><div style="text-align:center; border-radius:7px; padding:3px; border:1px solid black; color:black; background-color: {{ $tipo->color }} ">Test</div></td>
			<td><div style="text-align:center; border-radius:7px; padding:3px; border:1px solid black; color:black; background-color: {{ $tipo->color_realizada }} ">Test</div></td>
		</tr>
		@endforeach
	</table>
</div>
<!--Modal tipoact-->
<form method="post" action="{{url('/tipoact')}}" id="form">
@csrf
	<div class="modal" tabindex="-1" role="dialog" id="modaltipoact">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar tipo de actividad</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="empresa">Tipo de actividad:</label>
							<input type="text" class="form-control" name="tipo">
						</div>
						<div class="form-group col-md-6">
							<label for="telefono">Orden:</label>
							<input type="text" class="form-control" name="orden">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="color">Color activa:</label>
							<input type="color" class="form-control" name="color">
						</div>
						<div class="form-group col-md-6">
							<label for="color_realizada">Color realizada:</label>
							<input type="color" class="form-control" name="color_realizada">
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

@endsection