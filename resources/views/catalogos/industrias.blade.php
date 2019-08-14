@extends('layout')
@section('content')


<h3 class='text-center'>Industrias</h3>

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalindustria" id="open">Agregar industria</button>
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
				<th>Industria</th>
				<th>Orden</th>
			</tr>
		</thead>
		@foreach($industrias as $industria)
		<tr>
			<td>
				<a href="/industria/{{ $industria->id }}/form"><i class="far fa-edit"></i></a>&nbsp;
				<a href="/industrias/delete/{{ $industria->id }}"><i class="far fa-trash-alt"></i></a>
			</td>
			<td>{{ $industria->industria }}</td>
			<td>{{ $industria->orden }}</td>
		</tr>
		@endforeach
	</table>
</div>
<!--Modal procedencia-->
<form method="post" action="{{url('/industria')}}" id="form">
@csrf
	<div class="modal" tabindex="-1" role="dialog" id="modalindustria">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar industria</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="industria">Industria:</label>
							<input type="text" class="form-control" name="industria">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="orden">Orden:</label>
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