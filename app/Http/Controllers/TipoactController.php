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
            'color_realizada'=> 'required',
    	]);

    	$tipo = new Tipoact;
    	$tipo->tipo = $request->get('tipo');
    	$tipo->orden = $request->get('orden');
    	$tipo->color = $request->get('color');
        $tipo->color_realizada = $request->get('color_realizada');

    	$tipo->save();
    	
        return redirect()->back();
    }

    function update(Request $request, $id){
        $validated = $request->validate([
            'tipo'=> 'required',
            'orden'=> 'required',
            'color'=> 'required',
            'color_realizada'=> 'required',
        ]);

        $tipo = Tipoact::find($id);
        $tipo->tipo = $request->get('tipo');
        $tipo->orden = $request->get('orden');
        $tipo->color = $request->get('color');
        $tipo->color_realizada = $request->get('color_realizada');

        $tipo->save();
        
        return redirect('/tipoacts');
    }

    function form($id){
        $tipo = Tipoact::find($id);
        return view('pages.tipoact_edit',compact('tipo'));
    }

    function destroy($id){
    	$etapa = Tipoact::find($id);

    	$etapa->delete();

        return redirect()->back();
    }
}
