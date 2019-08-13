<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\Procedencia;
use App\Etapa;
use App\Actividad;
use App\Tipoact;
use App\Industry;

class ProspectoController extends Controller
{
    //
	function index(){
		$prospectos = Prospecto::paginate(30);
        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
		return view('pages.prospectos',compact('prospectos','procedencias','etapas','industrias'));
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
        $prospecto->etapa = $request->get('etapa');
    	$prospecto->valor = $request->get('valor');    
        $prospecto->userid = auth()->user()->id;

    	$prospecto->save();

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
        $prospecto->etapa = $request->get('etapa');
        $prospecto->valor = $request->get('valor');
        $prospecto->userid = auth()->user()->id;

        $prospecto->save();

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
        return view ('pages.prospecto_reg',compact('prospecto','tipos'));
    }

    function destroyact($id){
        $actividad = Actividad::find($id);
        $actividad->delete();
        return back();
    }

}
