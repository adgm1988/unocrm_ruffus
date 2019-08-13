<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedencia;

class ProcedenciaController extends Controller
{
    //
    function index(){
        $procedencias = Procedencia::all();
        $procedencias = $procedencias->sortBy('orden');

        return view('catalogos.procedencia',compact('procedencias'));
    }

    function store(Request $request){
    	$validated = $request->validate([
    		'procedencia'=> 'required',
    		'orden'=> 'required',
    	]);

    	$procedencia = new Procedencia;
    	$procedencia->procedencia = $request->get('procedencia');
    	$procedencia->orden = $request->get('orden');

    	$procedencia->save();
    	
        return redirect()->back();
    }

    function update(Request $request, $id){
        $validated = $request->validate([
            'procedencia'=> 'required',
            'orden'=> 'required',
        ]);

        $procedencia = Procedencia::find($id);
        $procedencia->procedencia = $request->get('procedencia');
        $procedencia->orden = $request->get('orden');

        $procedencia->save();
        
        return redirect('/procedencias');
    }

    function form($id){
        $procedencia = Procedencia::find($id);
        return view('pages.procedencia_edit',compact('procedencia'));
    }

    function destroy($id){
    	$etapa = Procedencia::find($id);

    	$etapa->delete();
    	
        return redirect()->back();
    }
}
