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
use Auth;

class IndicadoresController extends Controller
{
    public function index(){
    	$userid = Auth::user()->id;

    	if (Auth::user()->vendedor){
    		$ventasemanalusuario = DB::table('ventas')
		    ->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v") as semana'), DB::raw('sum(ventas.monto) as suma'))
		    ->join('prospectos', 'ventas._prospectoid', '=', 'prospectos.id')
		    ->where('prospectos.userid',Auth::user()->id)
		    ->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v")'))
		    ->get();
		    $ventasemanal = $ventasemanalusuario->sortKeys();

		    $ventamensualusuario = DB::table('ventas')
		    ->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m") as mes'), DB::raw('sum(ventas.monto) as suma'))
		    ->join('prospectos', 'ventas._prospectoid', '=', 'prospectos.id')
		    ->where('prospectos.userid',Auth::user()->id)
		    ->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m")'))
		    ->get();
		    $ventamensual = $ventamensualusuario->sortKeys();

		    $ventatrimestralusuario = DB::table('ventas')
		    ->select(DB::raw('concat(DATE_FORMAT(ventas.fecha, "%Y-"), QUARTER(ventas.fecha)) as mes'), DB::raw('sum(ventas.monto) as suma'))
		    ->join('prospectos', 'ventas._prospectoid', '=', 'prospectos.id')
		    ->where('prospectos.userid',Auth::user()->id)
		    ->groupBy(DB::raw('mes'))
		    ->get();
		    $ventatrimestral = $ventatrimestralusuario->sortKeys();

    	}else{

		    $ventasemanalusuario = DB::table('ventas')
		    ->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v") as semana'), DB::raw('sum(ventas.monto) as suma'))
		    ->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v")'))
		    ->get();
		    $ventasemanal = $ventasemanalusuario->sortKeys();

		    $ventamensualusuario = DB::table('ventas')
		    ->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m") as mes'), DB::raw('sum(ventas.monto) as suma'))
		    ->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m")'))
		    ->get();
		    $ventamensual = $ventamensualusuario->sortKeys();

		    $ventatrimestralusuario = DB::table('ventas')
		    ->select(DB::raw('concat(DATE_FORMAT(ventas.fecha, "%Y-"),QUARTER(ventas.fecha)) as mes'), DB::raw('sum(ventas.monto) as suma'))
		    ->groupBy(DB::raw('mes'))
		    ->get();
		    $ventatrimestral = $ventatrimestralusuario->sortKeys();
		}



    	return view('pages.indicadores',compact('ventasemanal','ventamensual','ventatrimestral'));
    }
}
