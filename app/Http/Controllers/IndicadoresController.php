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
