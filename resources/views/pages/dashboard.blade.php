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
				<td style="padding:3px;">
					@foreach($prospectos as $prospecto)
					@if($prospecto->etapas->etapa == $etapa->etapa)
					
					<!--
					<div style="background-color: {{ $etapa->color }}" class="card text-white o-hidden h-100 mb-1">
						<div class="card-body p-1">
							<div class="card-body-icon">
								<i class="fas fa-fw fa-life-ring"></i>
							</div>
							<div class="">{{ $prospecto->empresa }}</div>
						</div>
						<a class="card-footer text-white clearfix small z-1 p-1" href="#">
							<span class="float-left">${{ $prospecto->valor }} - {{ $prospecto->contacto }}</span>
							<span class="float-right">
								<i class="fas fa-angle-right"></i>
							</span>
						</a>
					</div>
				-->
				
					<a style="text-decoration:none; color:black;" href="/prospectos/{{ $prospecto->id }}">
						<div style="width:98%; box-shadow: 2px 2px #888888; border: 1px solid gray; background-color:white; border-bottom:5px solid {{ $etapa->color }} ; border-radius:4px; padding:5px; margin:auto; margin-bottom:5px;">
							<div><span style="font-size:12px; font-weight:bold;">{{ $prospecto->empresa }}</span> <span style="color:gray; font-size: 9px; float:right;">${{ $prospecto->valor }}</span></div>
							<div style="clear:both"></div>
							<hr style="margin:0px;">
							<div><span style="font-size:10px; font-weight:bold;">{{ $prospecto->contacto }}</span> <span style="color:{{ $prospecto->semaforo }}; font-size: 16px; float:right;"><i class="far fa-arrow-alt-circle-right"></i></span></div>
							<div style="clear:both"></div>
						</div>
					</a>

					@endif
					@endforeach
				</td>

				@endforeach

						
		</tr>
	</table>
</div>

@endsection