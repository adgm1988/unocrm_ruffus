@extends('layout')
@section('content')








<h5>Procedencias</h5>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalprocedencia" id="open">Agregar tipo</button>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Procedencia</th>
				<th>Orden</th>
			</tr>
		</thead>
		@foreach($procedencias as $procedencia)
		<tr>
			<td>
				<a href="#" data-toggle="modal" data-target="#myModal" id="open"><i class="far fa-edit"></i></a>&nbsp;
				<a href="/procedencias/delete/{{ $procedencia->id }}"><i class="far fa-trash-alt"></i></a>
			</td>
			<td>{{ $procedencia->procedencia }}</td>
			<td>{{ $procedencia->orden }}</td>
		</tr>
		@endforeach
	</table>
</div>
<!--Modal procedencia-->
<form method="post" action="{{url('config/procedencia')}}" id="form">
@csrf
	<div class="modal" tabindex="-1" role="dialog" id="modalprocedencia">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar procedencia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="empresa">Procedencia:</label>
							<input type="text" class="form-control" name="procedencia">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="telefono">Orden:</label>
							<input type="text" class="form-control" name="orden">
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