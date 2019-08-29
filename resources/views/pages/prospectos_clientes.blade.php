@extends('layout')
@section('content')

<h3 class='text-center'>Directorio de clientes activos <span style="color:gray; font-size:16px;">({{ $prospectos->count() }})</span></h3>
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

<!--CAMPO DE SEARCH-->
<div class="row ">
    <div class="col-6">
        <form action="/clientesearch" method="post">
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
        <tr style="border-left:10px solid {{ $prospecto->indicador }};">    
         <td nowrap>
            <a href="/prospectos/{{ $prospecto->id }}"><i class="far fa-eye"></i></a>&nbsp;
            <a href="/prospectos/{{ $prospecto->id }}/form"><i class="far fa-edit"></i></a>&nbsp;
            <a href="/prospectos/delete/{{ $prospecto->id }}"><i class="far fa-trash-alt"></i></a>
        </td>
        <td nowrap><i style="font-size:10px; color:{{ $prospecto->semaforo }}" class="fas fa-circle"></i> {{ $prospecto->empresa }} </td>      
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
    
</script>