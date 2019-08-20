@extends('layout')
@section('content')

<button style="float:left;" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" id="open">Agregar</button>
<h3 class='text-center'>Directorio de prospectos</h3>
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
                            <label for="empresa">Empresa:</label>
                            <input type="text" class="form-control" name="empresa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="contacto">Contacto:</label>
                            <input type="text" class="form-control" name="contacto">
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
                            <label for="procedencia">Industria:</label>
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
                  <option value="empresa">Empresa</option>
                  <option value="contacto">Contacto</option>
                  <option value="telefono">Telefono</option>
                  <option value="correo">Correo</option>
                  <option value="valor">Valor</option>
                  <option value="etapa">Etapa</option>
                  <option value="procedencia">Procedencia</option>
                  <option value="industria">Industria</option>
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
    <div class="alert alert-info p-1 pl-3" role="alert">
        {{ $filtro }}
    </div>
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
				<th>Empresa</th>
                <th>Etapa</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Procedencia</th>
                <th>Industria</th>
                <th>Valor</th>								
                <th>Responsable</th>				
            </tr>
        </thead>
        @foreach($prospectos as $prospecto)
        <tr style="border-left:10px solid {{ $prospecto->semaforo }};">		
         <td nowrap>
            <a href="/prospectos/{{ $prospecto->id }}"><i class="far fa-eye"></i></a>&nbsp;
            <a href="/prospectos/{{ $prospecto->id }}/form"><i class="far fa-edit"></i></a>&nbsp;
            <a href="/prospectos/delete/{{ $prospecto->id }}"><i class="far fa-trash-alt"></i></a>
        </td>
        <td nowrap><i style="font-size:10px; color:{{ $prospecto->semaforo }}" class="fas fa-circle"></i> {{ $prospecto->empresa }}</td>	     
        <td> <div style="border-radius: 10px; font-weight:bold; text-align:center; width:100px; height:25px; border:1px solid black; background-color: {{ $prospecto->etapas->color }}">{{ $prospecto->etapas->etapa }} </div></td>    	
        <td nowrap>{{ $prospecto->contacto }}</td>		
        <td>{{ $prospecto->telefono }}</td>		
        <td>{{ $prospecto->correo }}</td>		
        <td>{{ $prospecto->procedencias->procedencia }}</td>		
        <td>{{ $prospecto->industrias->industria }}</td>		
        <td>${{ number_format($prospecto->valor,2,".",",") }}</td>		
        <td>{{ $prospecto->user->name }}</td>	
    </tr>
    @endforeach
</table>

</div>

{{ $prospectos->links() }}



@endsection

<script>
    document.Ready(function (){
        alert('si');
    });
</script>