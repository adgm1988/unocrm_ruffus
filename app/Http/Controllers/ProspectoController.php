<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\Procedencia;
use App\Etapa;
use App\Actividad;
use App\Tipoact;
use App\Industry;
use App\Bitacora;

class ProspectoController extends Controller
{
    //
	function index(){
		$prospectos = Prospecto::paginate(30);
        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        $filtro='';
		return view('pages.prospectos',compact('prospectos','procedencias','etapas','industrias','filtro'));
	}

    function search(Request $request){
        $campo = $request->get('campo');
        $valor = $request->get('valor');
        $condicion = $request->get('condicion');

        switch ($condicion){
            case "contiene":  // if $var == "x"
                $prospectos = Prospecto::where($campo,'like','%'.$valor.'%')->paginate(30);
                $condicion_texto= "contiene";
                break;
            case "mayor":  // if $var == "y"
                $prospectos = Prospecto::where($campo,'>',$valor)->paginate(30);
                $condicion_texto= "es mayor que";
                break;
            case "menor":  // if $var == "y"
                $prospectos = Prospecto::where($campo,'<',$valor)->paginate(30);
                $condicion_texto= "es menor que";
                break;
            default:  // if $var != "x" && != "y"
                $prospectos = Prospecto::paginate(30);
                break;
       }

        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        $filtro = ucfirst($campo)." ".$condicion_texto." ". $valor;
        return view('pages.prospectos',compact('prospectos','procedencias','etapas','industrias','filtro'));
    }

    function store(Request $request)
    {

    	$validatedData = $request->validate([
	        'empresa' => 'required',
	        'contacto' => 'required',
	        'telefono' => 'required',
	        'correo' => 'required',
	        'procedencia' => 'required',
            'industria' => 'required',
	        'valor' => 'required',
            'etapa' => 'required',

    	]);


    	//aqui hay error porque no paso la info vlaidada

    	$prospecto = new Prospecto;
    	$prospecto->empresa = $request->get('empresa');
    	$prospecto->contacto = $request->get('contacto');
    	$prospecto->telefono = $request->get('telefono');
    	$prospecto->correo = $request->get('correo');
    	$prospecto->procedencia = $request->get('procedencia');
        $prospecto->industria = $request->get('industria');
        $prospecto->etapa_id = $request->get('etapa');
    	$prospecto->valor = $request->get('valor');    
        $prospecto->userid = auth()->user()->id;

    	$prospecto->save();

        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->tipo = "Nuevo prospecto";
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = "Creación de prospecto";


        $bitacora->save();


    	return redirect('prospectos');
    }

    function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'empresa' => 'required',
            'contacto' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'procedencia' => 'required',
            'industria' => 'required',
            'valor' => 'required',
            'etapa' => 'required',
        ]);


        //aqui hay error porque no paso la info vlaidada

        $prospecto = Prospecto::find($id);
        $prospecto->empresa = $request->get('empresa');
        $prospecto->contacto = $request->get('contacto');
        $prospecto->telefono = $request->get('telefono');
        $prospecto->correo = $request->get('correo');
        $prospecto->procedencia = $request->get('procedencia');
        $prospecto->industria = $request->get('industria');
        $prospecto->etapa_id = $request->get('etapa');
        $prospecto->valor = $request->get('valor');
        $prospecto->userid = auth()->user()->id;

        $prospecto->save();

        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->tipo = "Edicion de prospecto";
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = "Se edito la información general del prospecto";


        $bitacora->save();

        $tipos = Tipoact::all();
        return view ('pages.prospecto_reg',compact('prospecto','tipos'));
    }

    function form($id){
        $prospecto = Prospecto::find($id);
        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        return view('pages.prospecto_edit',compact('prospecto','procedencias','etapas','industrias'));
    }

    function destroy($id){
    	$prospecto = Prospecto::find($id);
        $procedencias = Procedencia::all();

    	$prospecto->delete();

    	$prospectos = Prospecto::all();

    	return redirect('prospectos');
    }

    function show($id){
        $prospecto = Prospecto::find($id);
        $tipos = Tipoact::all();
        $etapas = Etapa::all();
        return view ('pages.prospecto_reg',compact('prospecto','tipos','etapas'));
    }

    function destroyact($id){
        $actividad = Actividad::find($id);
        $actividad->delete();
        return back();
    }

    function cambioetapa($id, Request $request){
        $prospecto = Prospecto::find($id);
        $prospecto->etapa_id = $request->get('etapa');
        $prospecto->save();

        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->tipo = "Cambio de etapa";
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = "Se cambió la etapa de prospecto a ".$prospecto->etapas->etapa;

        $bitacora->save();

         return redirect('/prospectos/'.$id);
    }

}
