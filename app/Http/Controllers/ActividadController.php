<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Tipoact;
use App\Prospecto;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class ActividadController extends Controller
{
    //
    function index(){

        if(auth::user()->vendedor == 1){
           // $actividades = Actividad::orderBy('fecha', 'DESC')->get();

            $actividades = Actividad::with('Prospecto')->whereHas('Prospecto', function($q){
                $q->where('userid', auth::user()->id);
            })->get();

            $prospectos = Prospecto::all();
        }else{
            $actividades = Actividad::orderBy('fecha', 'DESC')->get();
            $prospectos = Prospecto::all();
        }
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
    	]);

    	$actividad = new Actividad;
    	$actividad->_prospectoid = $request->get('prospecto');
    	$actividad->_tipoactid = $request->get('actividad');
    	$actividad->fecha = $request->get('fecha');
    	$actividad->hora = $request->get('hora');
        $actividad->duracion = $request->get('duracion');
    	$actividad->descripcion = $request->get('descripcion');
    	$actividad->resultado = $request->get('resultado');

        /* //Mejor dejo la bitacora solamente para cambio de estatus.
        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $actividad->_prospectoid;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->tipo = "Nueva ".$actividad->tiposdeact->tipo." id:".$actividad->id;
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = $actividad->descripcion. " con resultado: ".$actividad->resultado;


        $bitacora->save();

    	$actividad->save();
        */

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


        /**
        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $actividad->_prospectoid;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->tipo = "Nueva ".$actividad->tiposdeact->tipo." id:".$actividad->id;
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = $actividad->descripcion. " con resultado: ".$actividad->resultado;


        $bitacora->save();
        **/

        return back();

    }


     function update(Request $request, $id, $origen){


        $validated= $request->validate([
            'actividad'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'duracion'=>'required',
            'descripcion'=>'required'
        ]);

        $actividad = Actividad::find($id);
        $actividad->_tipoactid = $request->get('actividad');
        $actividad->fecha = $request->get('fecha');
        $actividad->hora = $request->get('hora');
        $actividad->duracion = $request->get('duracion');
        $actividad->descripcion = $request->get('descripcion');
        $actividad->resultado = $request->get('resultado');

        $actividad->save();


        /**
        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $actividad->_prospectoid;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->tipo = "Actualización de ".$actividad->tiposdeact->tipo." id:".$actividad->id;
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = $actividad->descripcion. " con resultado: ".$actividad->resultado;

        $bitacora->save();
        **/

        if($origen == 'prospecto'){
            return redirect('/prospectos/'.$actividad->_prospectoid);
        }else{
            return redirect('/actividades');
        }
        

    }

    function form($id, $prospecto = null){
        $prospectos = Prospecto::all();
        $actividad = Actividad::find($id);
        $tipos = Tipoact::all();
        if($prospecto){
            $origen='prospecto';
        }else{
            $origen='actividad';
        }
        return view('pages.actividad_edit',compact('actividad','tipos','prospectos','origen'));

    }

    function destroy($id, $prospecto = null){
    	$actividad = Actividad::find($id);
        $prospecto_id = $actividad->prospecto->id;

    	$actividad->delete();

        if($prospecto='prospecto'){
             return redirect('/prospectos/'.$prospecto_id);
        }else{
            return redirect('actividades');
        }

    	
    }
	
}
