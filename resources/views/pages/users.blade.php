@extends('layout')
@section('content')



<h3 class='text-center'>Directorio de usuarios</h3>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#myModal" id="open">Agregar usuario</button>

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<form method="post" action="{{url('register')}}" id="form">
	@csrf

	<!-- Modal agregar -->
	<div class="modal" tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Agregar usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="empresa">Nombre:</label>
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="contacto">Correo:</label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="telefono">Contraseña:</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="telefono">Confirmar contraseña:</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="correo">Consultor:</label>
							<input type="checkbox"  name="consultor">
						</div>
						<div class="form-group col-md-4">
							<label for="correo">Director:</label>
							<input type="checkbox"  name="director">
						</div>
						<div class="form-group col-md-4">
							<label for="correo">Vendedor:</label>
							<input type="checkbox"  name="vendedor">
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button  class="btn btn-success" >Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>








<form method="post" action="{{url('usuario')}}" id="form">
	@csrf

	<!--Modal editar-->
	<div class="modal" tabindex="-1" role="dialog" id="myModaledit">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display:none"></div>
				<div class="modal-header">

					<h5 class="modal-title">Editar usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="empresa">Nombre:</label>
							<input type="text" class="form-control" name="empresa">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="contacto">Correo:</label>
							<input type="email" class="form-control" name="contacto">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="telefono">Contraseña:</label>
							<input type="text" class="form-control" name="telefono">
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="correo">Admin:</label>
							<input type="checkbox"  name="correo">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button  class="btn btn-success" >Guardar</button>
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
				<th>id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Consultor Uno</th>		
				<th>Director</th>		
				<th>Ventas</th>		
			</tr>
		</thead>
		@foreach($users as $user)
		<tr>		
			<td>
				<a href="#"><i class="far fa-eye"></i></a>&nbsp;
				<a href="#" data-toggle="modal" data-target="#myModaledit" id="open"><i class="far fa-edit"></i></a>&nbsp;
				<a href="/users/delete/{{ $user->id }}"><i class="far fa-trash-alt"></i></a>
			</td>
			<td>{{ $user->id }}</td>		
			<td>{{ $user->name }}</td>		
			<td>{{ $user->email }}</td>		
			<!--<td>{{ $user->admin }}</td>	-->	
			<td>{{ $user->consultor }}</td>		
			<td>{{ $user->director }}</td>		
			<td>{{ $user->vendedor }}</td>		
		</tr>
		@endforeach
	</table>
</div>



@endsection