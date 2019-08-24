@extends('layout')
@section('content')

<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			
			<tr>
				@foreach($etapas as $key=>$etapa)
					<th class='text-center'>
						<div>{{ $etapa->etapa }} <span style="font-size:10px; color:gray;"> ({{ $etapa->prospectos_count }})</span></div>
						<div style="font-size:12px; color: {{ $etapa->color }}">${{ number_format($etapa->suma,0) }}</div>
					</th>
				@endforeach
			</tr>
			
		</thead>
		<tr style="background-color:lightgray;">
			
				@foreach($etapas as $etapa)
				<td style="padding:3px; min-width:200px; max-width:200px; ">
					@foreach($prospectos as $prospecto)
					@if($prospecto->etapas->etapa == $etapa->etapa)				
					
					<div style="width:98%; box-shadow: 2px 2px #888888; border: 1px solid gray; background-color:white; border-bottom:5px solid {{ $etapa->color }} ; border-radius:4px; padding:5px; margin:auto; margin-bottom:5px; ">
						<div>
							<div style="padding-right:5px; overflow:hidden;">
								<span style="font-size:12px; font-weight:bold; margin-left:5px; white-space:nowrap; "><i style="font-size:10px; color:{{ $prospecto->semaforo }}" class="fas fa-circle"></i> {{ $prospecto->empresa }}</span> 
							</div>
							
							<br>
							<hr style="margin:2px;">
							<span style="font-size:10px; font-weight:bold; float:left;">{{ $prospecto->contacto }}</span> 
							<span style="color:gray; font-size: 9px; float:right;">${{ $prospecto->valor }}</span>
						</div>
						<div style="clear:both"></div>
						
						<hr style="margin:4px;">
						<div style="width:100%">
							<a style="text-decoration:none; color:black;" href="/prospectos/{{ $prospecto->id }}">
								<button style="box-shadow: 2px 2px 2px grey; color:#eaeaea; background-color:#343a40; float:left; width:49%" class="btn btn-sm p-0"><i class="far fa-eye"></i></button>
							</a>
							<button style="box-shadow: 2px 2px 2px grey; color:#eaeaea; background-color:#343a40; float:right; width:49%" class="btn btn-sm p-0"><i class="far fa-handshake" style="font-weight:bold;"></i></button>
						</div>
						<div style="clear:both"></div>
					</div>
					

					@endif
					@endforeach
				</td>

				@endforeach

						
		</tr>
	</table>
</div>

<script>
	


</script>

@endsection