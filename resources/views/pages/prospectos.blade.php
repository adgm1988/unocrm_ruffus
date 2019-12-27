@extends('layout')
@section('content')

<button style="float:left;" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" id="open">Agregar</button>

@if(auth::user()->admin ==1 || auth::user()->consultor ==1)
    <a href="/prospecto/export"><button style="float:left; margin-left:10px;" type="button" class="btn btn-info btn-sm" >Exportar</button></a>
@endif
<h3 class='text-center'>Directorio de prospectos <span style="color:gray; font-size:16px;">({{ $cant }})</span></h3>
<!-- Trigger the modal with a button -->


@if ($errors->any())
<div class="alert alert-danger">
	<strong>Revisar los datos ingresados!<br><br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<form method="post" action="{{url('prospectos')}}" id="form">
    @csrf

    <!-- Modal agregar -->
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">

                    <h5 class="modal-title">Agregar prospecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="contacto">Contacto:</label>
                            <input type="text" class="form-control" name="contacto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="instagram">Instagram:</label>
                            <input type="text" class="form-control" name="instagram">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="dogname">Nombre mascota:</label>
                            <input type="text" class="form-control" name="dogname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="dogsize">Tamaño de perro:</label>
                            <select name="dogsize" id="dogsize" class="form-control">
                                <option value="na">-</option>
                                <option value="xs">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="correo">Correo:</label>
                            <input type="text" class="form-control" name="correo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="procedencia">Procedencia:</label>
                            <select class="custom-select" name="procedencia">
                                @foreach($procedencias as $procedencia)
                                <option value='{{ $procedencia->id }}'>{{ $procedencia->procedencia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="procedencia">Servicio:</label>
                            <select class="custom-select" name="industria">
                                @foreach($industrias as $industria)
                                <option value='{{ $industria->id }}'>{{ $industria->industria }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="procedencia">Etapa:</label>
                            <select class="custom-select" name="etapa">
                                @foreach($etapas as $etapa)
                                <option value='{{ $etapa->id }}'>{{ $etapa->etapa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="valor">Valor de oportunidad:</label>
                            <input type="number" step=".01" class="form-control" name="valor">
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

<!--CAMPO DE SEARCH-->
<div class="row ">
    <div class="col-6">
        <form action="/prospectosearch" method="post">
            @csrf
          <div class="form-row">

            <div class="col">
              <select class="form-control form-control-sm" name="campo" id="campo">
                  <option value="contacto">Contacto</option>
                  <option value="instagram">Instagram</option>
                  <option value="dogname">Nombre mascota</option>
                  <option value="dogsize">Tamaño mascota</option>
                  <option value="telefono">Telefono</option>
                  <option value="correo">Correo</option>
                  <option value="valor">Valor</option>
                  <option value="etapa">Etapa</option>
                  <option value="procedencia">Procedencia</option>
                  <option value="industria">Servicio</option>
                  <option value="usuario">Usuario</option>
              </select>
          </div>
          <div class="col">
              <select class="form-control form-control-sm" name="condicion" id="condicion">
                  <option value="contiene">contiene</option>
                  <option value="mayor">es mayor que</option>
                  <option value="menor">es menor que</option>
              </select>
          </div>
          <div class="col">
              <input type="text" class="form-control form-control-sm" placeholder="" name="valor">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-info btn-sm">Buscar</button>
        </div>
    </div>
</form>
    
</div>
@if ($filtro)
    <div class="col-6">
        <a style="text-decoration:none;" href="/prospectos">
    <div class="alert alert-info p-1 pl-3" role="alert">
        {{ $filtro }}
    </div>
</a>
    </div>
    @endif
</div>

<!--Display de filtro para cuando pueda agregar multiples
@if ($filtro)
<span class="badge badge-pill badge-secondary p-2">{{ $filtro }}<span style="margin-left:5px; cursor: pointer;"> <i class="far fa-times-circle"></i></span></span>
@endif
-->


<div class="table-responsive">
	<table class="table table-sm table-hover table-striped">
		<thead>
			<tr>
				<th></th>
                <th>Contacto</th>
                <th>Instagram</th>
				<th>Mascota</th>
                <th>Etapa</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Procedencia</th>
                <th>Industria</th>
                <th>Valor</th>								
                <th>Responsable</th>				
            </tr>
        </thead>
        @if(is_null($prospectos))
                <tr>
                    <td colspan="10">No existen registros que mostrar </td>
                </tr>
        @else
            @foreach($prospectos as $prospecto)
            <tr style="border-left:10px solid {{ $prospecto->indicador }};">		
                 <td nowrap>
                    <a href="/prospectos/{{ $prospecto->id }}"><i class="far fa-eye"></i></a>&nbsp;
                    <a href="/prospectos/{{ $prospecto->id }}/form"><i class="far fa-edit"></i></a>&nbsp;
                    @if( $prospecto->hijos < 1  )
                        <a onclick="return confirm('¿Estas seguro de querer eliminar este prospecto?')" href="/prospectos/delete/{{ $prospecto->id }}"><i class="far fa-trash-alt"></i></a>
                    @endif
                </td>
                <td nowrap><i style="font-size:10px; color:{{ $prospecto->semaforo }}" class="fas fa-circle"></i> {{ $prospecto->contacto }} </td>	     
                <td nowrap>{{ $prospecto->instagram }}</td>		
                <td nowrap>{{ $prospecto->dogname }}({{$prospecto->dogsize}})</td>     
                <td> <div style="border-radius: 10px; font-weight:bold; text-align:center; width:100px; height:25px; border:1px solid black; background-color: {{ $prospecto->etapas->color }}">{{ $prospecto->etapas->etapa }} </div></td>
                <td>{{ $prospecto->telefono }}</td>		
                <td>{{ $prospecto->correo }}</td>		
                <td>{{ $prospecto->procedencias->procedencia }}</td>		
                <td>{{ $prospecto->industrias->industria }}</td>		
                <td>${{ number_format($prospecto->valor,2,".",",") }}</td>		
                <td>{{ $prospecto->user->name }}</td>	
            </tr>
            @endforeach
        @endif
</table>

</div>

{{ $prospectos->links() }}



@endsection

<script>
    
</script>