@extends('layout')
@section('content')



<button style="float:left;" type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#modalactividad" id="open">Agregar</button>
@if(auth::user()->admin ==1 || auth::user()->consultor ==1)
    <a href="/ventas/export"><button style="float:left; margin-left:10px;" type="button" class="btn btn-info btn-sm" >Exportar</button></a>
@endif
<h3 class='text-center'>Listado de Ventas</h3>


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

<form method="post" action="{{url('ventas')}}" id="form">
	@csrf

	<!-- Modal agregar -->
	<div class="modal" tabindex="-1" role="dialog" id="modalactividad">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar venta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							

							<label for="prospecto">Prospecto:</label>
							<select class="custom-select" name="prospecto">
								@foreach($prospectos as $prospecto)
								<option value='{{ $prospecto->id }}'>{{ $prospecto->contacto }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="fecha">Fecha:</label>
							<input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}">
						</div>
						<div class="form-group col-md-6">
							<label for="fecha">Monto:</label>
							<input type="number" class="form-control" name="monto" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="detalle">Descripcion:</label>
							<textarea class="form-control" rows="5" id="detalle" name="detalle"></textarea>
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




<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Prospecto</th>
				<th>Fecha</th>
				<th>Monto</th>
				<th>Detalle</th>
				<th>Responsable</th>
			</tr>
		</thead>
		@if($ventas->count()>0)
			@foreach($ventas as $venta)
			<tr>		
				<td nowrap>
					<a href="/venta/{{ $venta->id }}/form"><i class="far fa-edit"></i></a>&nbsp;
					<a onclick="return confirm('¿Estas seguro de querer eliminar esta venta?')" href="ventas/delete/{{ $venta->id }}"><i class="far fa-trash-alt"></i></a>
				</td>
				<td>{{ $venta->prospecto->empresa }}</td>		
				<td nowrap>{{ $venta->fecha }}</td>		
				<td nowrap>$ {{ number_format($venta->monto,2,".",",") }}</td>		
				<td nowrap>{{ $venta->detalle }}</td>		
				<td nowrap>{{ $venta->prospecto->user->name }}</td>		
			</tr>
			@endforeach
		@else
			<tr>
				<td>No hay ventas registradas</td>
			</tr>	
		@endif
	</table>
</div>

@endsection