<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etapa;

class EtapaController extends Controller
{
    //
    function index(){
        $etapas = Etapa::all();
        $etapas = $etapas->sortBy('orden');

        return view('catalogos.etapas',compact('etapas'));
    }

    function store(Request $request){
    	$validated = $request->validate([
    		'etapa'=> 'required',
    		'orden'=> 'required',
    		'color'=> 'required',
    	]);

    	$etapa = new Etapa;
    	$etapa->etapa = $request->get('etapa');
    	$etapa->orden = $request->get('orden');
    	$etapa->color = $request->get('color');

    	$etapa->save();
  	
        return redirect()->back();
    }

    function destroy($id){
    	$etapa = Etapa::find($id);

    	$etapa->delete();

        return redirect()->back();
    }
}
