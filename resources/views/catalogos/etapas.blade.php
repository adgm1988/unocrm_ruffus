@extends('layout')
@section('content')



<h3 class='text-center'>Etapas</h3>

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modaletapas" id="open">Agregar etapa</button>
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
				<th>Etapa</th>
				<th>Orden</th>
				<th>Color</th>
			</tr>
		</thead>
		@foreach($etapas as $etapa)
		<tr>
			<td>
				<a href="/etapas/{{ $etapa->id }}/form"><i class="far fa-edit"></i></a>&nbsp;
				<a href="/etapas/delete/{{ $etapa->id }}"><i class="far fa-trash-alt"></i></a>
			</td>
			<td>{{ $etapa->etapa }}</td>
			<td>{{ $etapa->orden }}</td>
			<td><div style="text-align:center; border-radius:7px; padding:3px; border:1px solid black; color:white; background-color: {{ $etapa->color }} ">Test</div></td>
		</tr>
		@endforeach
	</table>
</div>

<!--Modal etapas-->
<form method="post" action="{{url('/etapas')}}" id="form">
@csrf
	<div class="modal" tabindex="-1" role="dialog" id="modaletapas">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar etapa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="empresa">Etapa:</label>
							<input type="text" class="form-control" name="etapa">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="telefono">Orden:</label>
							<input type="text" class="form-control" name="orden">
						</div>
						<div class="form-group col-md-6">
							<label for="correo">Color:</label>
							<input type="color" class="form-control" name="color">
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