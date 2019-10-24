<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Prospecto;
use App\Tipoact;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    //

    function index(){
    	//para la parte de las actividades
    	$actividades = Actividad::all();
        $prospectos = Prospecto::all();
    	$tipos = Tipoact::all();


    	//para la parte del calendario
    	$events = [];

    	if(auth::user()->vendedor == 1){
           // $actividades = Actividad::orderBy('fecha', 'DESC')->get();

            $actividades = Actividad::with('Prospecto')->whereHas('Prospecto', function($q){
                $q->where('userid', auth::user()->id);
            })->get();
        }else{
            $actividades = Actividad::all();
        }

        if($actividades){
            foreach($actividades as $actividad){

                $hora = str_replace(':','',$actividad->hora);
                $duracion =  str_replace(':','',$actividad->duracion);
                $horafinal = str_pad($hora+$duracion,4,0,STR_PAD_LEFT);
                $color = $actividad->color;
                $textocalendario = $actividad->prospecto->empresa.'--'.$actividad->descripcion;
                $concatfechahorainicial = $actividad->fecha.'T'. $hora;
                $concatfechahorafinal = $actividad->fecha.'T'. $horafinal;
                $events[] = \Calendar::event(
                    $textocalendario, //event title
                    false, //full day event?
                    $concatfechahorainicial, //start time (you can also use Carbon instead of DateTime)
                    $concatfechahorafinal,
                    $actividad->id,
                    [
                        'color' => $color,
                        //'borderColor' => $actividad->prospecto->semaforo,
                        'url' => 'prospectos/'.$actividad->prospecto->id,
                        'description' => $actividad->descripcion,
                        //'editable' => true
                    ] //optionally, you can specify an event ID
                );
            }
        }
    	

		$calendar = \Calendar::addEvents($events) //add an array with addEvents
		    ->setOptions([ //set fullcalendar options
				'firstDay' => 1
			])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
		        'viewRender' => 'function() {}'
		    ]);

		//dd($calendar);
		return view('pages.calendar', compact('calendar','actividades','tipos','prospectos'));
    }
}
