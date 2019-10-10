<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Prospecto;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Exports\VentasExport;
use Maatwebsite\Excel\Facades\Excel;

class VentasController extends Controller
{
    //
    function index(){

        if(auth::user()->vendedor == 1){
           // $actividades = Actividad::orderBy('fecha', 'DESC')->get();

            $ventas = Venta::with('Prospecto')->whereHas('Prospecto', function($q){
                $q->where('userid', auth::user()->id);
            })->get();

            $prospectos = Prospecto::all();
        }else{
            $ventas = Venta::orderBy('fecha', 'DESC')->get();
            $prospectos = Prospecto::all();
        }
    	return view('pages.ventas',compact('ventas','prospectos'));
    }

    function store(Request $request){

    	$validated= $request->validate([
    		'prospecto'=>'required',
    		'fecha'=>'required',
    		'monto'=>'required'
    	]);

    	$venta = new Venta;
    	$venta->_prospectoid = $request->get('prospecto');
    	$venta->fecha = $request->get('fecha');
    	$venta->monto = $request->get('monto');
    	$venta->detalle = $request->get('detalle');

        $venta->save();
    	return redirect('ventas');

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
            'fecha'=>'required',
            'monto'=>'required'
        ]);

        $venta = new Venta;
        $venta->_prospectoid = $id;
        $venta->fecha = $request->get('fecha');
        $venta->monto = $request->get('monto');
        $venta->detalle = $request->get('detalle');

        $venta->save();

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
    	$venta = Actividad::find($id);
        $prospecto_id = $venta->prospecto->id;

    	$venta->delete();

        if($prospecto='prospecto'){
             return redirect('/prospectos/'.$prospecto_id);
        }else{
            return redirect('ventas');
        }

    	
    }

    public function export() {
        $date =  Carbon::now();
        $filename = 'ventas-'.$date.'.xlsx';
        return Excel::download(new VentasExport, $filename);
    }   
}
