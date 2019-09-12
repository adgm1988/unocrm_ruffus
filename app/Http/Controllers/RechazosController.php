<?php

namespace App\Http\Controllers;

use App\Rechazos;
use Illuminate\Http\Request;

class RechazosController extends Controller
{
    //
    function index(){
        $motivos = Rechazos::all();
        $motivos = $motivos->sortBy('orden');
        return view('catalogos.motivos',compact('motivos'));
    }

    function store(Request $request){
        $validated = $request->validate([
            'motivo'=> 'required',
            'orden'=> 'required',
        ]);
        $motivo = new Rechazos;
        $motivo->motivo = $request->get('motivo');
        $motivo->orden = $request->get('orden');
        $motivo->save();
        return redirect()->back();
    }

    function update(Request $request, $id){
        $validated = $request->validate([
            'motivo'=> 'required',
            'orden'=> 'required',
        ]);

        $motivo = Rechazos::find($id);
        $motivo->motivo = $request->get('motivo');
        $motivo->orden = $request->get('orden');
        $motivo->save();
        return redirect('/motivos');
    }

    function form($id){
        $motivo = Rechazos::find($id);
        return view('pages.motivo_edit', compact('motivo'));
    }

    function destroy($id){
        $motivo = Rechazos::find($id);
        $motivo->delete();
        return redirect()->back();
    }
}
