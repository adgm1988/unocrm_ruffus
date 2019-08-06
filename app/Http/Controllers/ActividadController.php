<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Tipoact;
use App\Prospecto;

class ActividadController extends Controller
{
    //

    function index(){

    	$actividades = Actividad::orderBy('fecha', 'DESC')->get();
        $prospectos = Prospecto::all();
    	$tipos = Tipoact::all();
    	return view('pages.actividades',compact('actividades','tipos','prospectos'));
    }

    function store(Request $request){

    	$validated= $request->validate([
    		'prospecto'=>'required',
    		'actividad'=>'required',
    		'fecha'=>'required',
    		'hora'=>'required',
            'duracion'=>'required',
    		'descripcion'=>'required',
    		'resultado'=>'required',
    	]);

    	$actividad = new Actividad;
    	$actividad->_prospectoid = $request->get('prospecto');
    	$actividad->_tipoactid = $request->get('actividad');
    	$actividad->fecha = $request->get('fecha');
    	$actividad->hora = $request->get('hora');
        $actividad->duracion = $request->get('duracion');
    	$actividad->descripcion = $request->get('descripcion');
    	$actividad->resultado = $request->get('resultado');


    	$actividad->save();

    	return redirect('actividades');

    }
    function storecal(Request $request){

        $validated= $request->validate([
            'prospecto'=>'required',
            'actividad'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'duracion'=>'required',
            'descripcion'=>'required',
            'resultado'=>'required',
        ]);

        $actividad = new Actividad;
        $actividad->_prospectoid = $request->get('prospecto');
        $actividad->_tipoactid = $request->get('actividad');
        $actividad->fecha = $request->get('fecha');
        $actividad->hora = $request->get('hora');
        $actividad->duracion = $request->get('duracion');
        $actividad->descripcion = $request->get('descripcion');
        $actividad->resultado = $request->get('resultado');


        $actividad->save();

        return back();

    }

     function storeprosp($id, Request $request){

        $validated= $request->validate([
            'actividad'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'duracion'=>'required',
            'descripcion'=>'required'
        ]);

        $actividad = new Actividad;
        $actividad->_prospectoid = $id;
        $actividad->_tipoactid = $request->get('actividad');
        $actividad->fecha = $request->get('fecha');
        $actividad->hora = $request->get('hora');
        $actividad->duracion = $request->get('duracion');
        $actividad->descripcion = $request->get('descripcion');
        $actividad->resultado = $request->get('resultado');


        $actividad->save();

        return back();

    }

    function destroy($id){
    	$actividad = Actividad::find($id);

    	$actividad->delete();

    	return redirect('actividades');
    }
	
}
