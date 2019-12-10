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
    	$vendedores = User::where('vendedor','=',1)->get();

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

    	return view('pages.indicadores',compact('vendedores','ventasemanal','ventamensual','ventatrimestral'));
    }


    public function filtro(Request $request){
    	
    	$vendedor_id = $request->get('vendedorid');
    	if($vendedor_id=='0'){
    		return redirect('/indicadores');
    	}

    	$vendedores = User::where('vendedor','=',1)->get();

    	$vendedor = User::find($vendedor_id);

		$ventasemanalusuario = DB::table('ventas')
		->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v") as semana'), DB::raw('sum(ventas.monto) as suma'))
		->join('prospectos','ventas._prospectoid','=','prospectos.id')
		->where('prospectos.userid','=',$vendedor_id)
		->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%v")'))
		->get();
		$ventasemanal = $ventasemanalusuario->sortKeys();

		$ventamensualusuario = DB::table('ventas')
		->select(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m") as mes'), DB::raw('sum(ventas.monto) as suma'))
		->join('prospectos','ventas._prospectoid','=','prospectos.id')
		->where('prospectos.userid','=',$vendedor_id)
		->groupBy(DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m")'))
		->get();
		$ventamensual = $ventamensualusuario->sortKeys();

		$ventatrimestralusuario = DB::table('ventas')
		->select(DB::raw('concat(DATE_FORMAT(ventas.fecha, "%Y-"),QUARTER(ventas.fecha)) as mes'), DB::raw('sum(ventas.monto) as suma'))
		->join('prospectos','ventas._prospectoid','=','prospectos.id')
		->where('prospectos.userid','=',$vendedor_id)
		->groupBy(DB::raw('mes'))
		->get();
		$ventatrimestral = $ventatrimestralusuario->sortKeys();

		return view('pages.indicadores',compact('vendedor','vendedores','ventasemanal','ventamensual','ventatrimestral'));

    }
}
