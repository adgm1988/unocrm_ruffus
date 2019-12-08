<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\User;
use App\Procedencia;
use App\Industry;
use App\Etapa;
use App\Tipoact;
use App\Venta;
use DB;

class IndicadoresController extends Controller
{
    public function index(){
    	$etapas = Etapa::all();
    	$tipoacts= Tipoact::all();
    	$vendedores= User::where('vendedor',1)->get();
        $user = 0;
        $desde ='';
        $hasta = '';

        $prospectos_cant = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                    ->where('estatus', 'prospecto')
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

        $clientes_cant = DB::table('prospectos')
                ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                ->where('estatus', 'cliente')
                ->groupBy('etapa')
                ->orderBy('etapas.orden')
                ->get();

        $perdidos_cant = DB::table('prospectos')
                ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                ->where('estatus', 'perdido')
                ->groupBy('etapa')
                ->orderBy('etapas.orden')
                ->get();

                //MONTOS
        $prospectos_val = DB::table('prospectos')
                ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                ->where('estatus', 'prospecto')
                ->groupBy('etapa')
                ->orderBy('etapas.orden')
                ->get();

         $clientes_val = DB::table('prospectos')
                ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                ->where('estatus', 'cliente') 
                ->groupBy('etapa')
                ->orderBy('etapas.orden')
                ->get();

        $perdidos_val = DB::table('prospectos')
                ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                ->where('estatus', 'perdido')
                ->groupBy('etapa')
                ->orderBy('etapas.orden')
                ->get();


///Venta semanal de todos
       	$ventasemanal = Venta::where('_prospectoid','=','51')->get()
	    ->groupBy(function ($venta) {
	        return date("Y-W", strtotime($venta->fecha));
	    })
	    ->map(function ($semana) {
	        return $semana->sum('monto');
	    });

	    //dd($ventasemanal->sortKeys());


///Venta semanal usuario
	    $ventasemanalusuario = DB::table('ventas')
	    ->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v") as semana'), DB::raw('sum(ventas.monto) as suma'))
	    ->join('prospectos', 'ventas._prospectoid', '=', 'prospectos.id')
	    ->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v")'))
	    ->get();
	    $ventasemanal = $ventasemanalusuario->sortKeys();

	    $ventamensualusuario = DB::table('ventas')
	    ->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m") as mes'), DB::raw('sum(ventas.monto) as suma'))
	    ->join('prospectos', 'ventas._prospectoid', '=', 'prospectos.id')
	    ->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m")'))
	    ->get();
	    $ventamensual = $ventamensualusuario->sortKeys();




    	return view('pages.indicadores',compact('etapas','tipoacts','prospectos_cant','clientes_cant','perdidos_cant','prospectos_val','clientes_val','perdidos_val','vendedores','user','ventasemanal','ventamensual'));
    }
}
