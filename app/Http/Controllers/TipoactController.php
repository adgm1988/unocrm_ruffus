<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipoact;

class TipoactController extends Controller
{
    //
    function index(){
        $tipos = Tipoact::all();
        $tipos = $tipos->sortBy('orden');

        return view('catalogos.tipoacts',compact('tipos'));

    }

    function store(Request $request){
    	$validated = $request->validate([
    		'tipo'=> 'required',
    		'orden'=> 'required',
    		'color'=> 'required',
    	]);

    	$tipo = new Tipoact;
    	$tipo->tipo = $request->get('tipo');
    	$tipo->orden = $request->get('orden');
    	$tipo->color = $request->get('color');

    	$tipo->save();
    	
        return redirect()->back();
    }

    function destroy($id){
    	$etapa = Tipoact::find($id);

    	$etapa->delete();

        return redirect()->back();
    }
}
