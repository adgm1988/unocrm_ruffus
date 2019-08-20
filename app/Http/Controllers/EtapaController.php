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
            'dias'=> 'required',
    		'color'=> 'required',
    	]);

    	$etapa = new Etapa;
    	$etapa->etapa = $request->get('etapa');
    	$etapa->orden = $request->get('orden');
        $etapa->dias = $request->get('dias');
    	$etapa->color = $request->get('color');

    	$etapa->save();
  	
        return redirect()->back();
    }

    function update(Request $request, $id){
        $validated = $request->validate([
            'etapa'=> 'required',
            'orden'=> 'required',
            'dias'=> 'required',
            'color'=> 'required',
        ]);

        $etapa = Etapa::find($id);
        $etapa->etapa = $request->get('etapa');
        $etapa->orden = $request->get('orden');
        $etapa->dias = $request->get('dias');
        $etapa->color = $request->get('color');

        $etapa->save();
    
        return redirect('/etapas');
    }

    function form($id){
        $etapa = Etapa::find($id);
        return view('pages.etapas_edit',compact('etapa'));
    }

    function destroy($id){
    	$etapa = Etapa::find($id);

    	$etapa->delete();

        return redirect()->back();
    }
}
