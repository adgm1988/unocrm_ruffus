<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\Etapa;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    //
    function index(){

        $etapas = Etapa::withCount('prospectos')->get(); //on esto ya saco la cantidad de propsectos por etapa
        $etapas = $etapas->sortBy('orden');

        if(auth::user()->vendedor == 1){
            $prospectos = Prospecto::where('estatus','like','prospecto')->where('userid','>',0)->get(); //puse esta condicion de id para no cambiar todo el query porque antes si userid era igual a authuserid pero ahora todos deben ver todos.
        

            $now = Carbon::now();
            $ano = $now->year;
            $mes = $now->month;

            $ventasmes = DB::table('ventas')
                ->select('ventas.fecha','ventas.monto','prospectos.userid')
                ->join('prospectos', 'ventas._prospectoid', '=', 'prospectos.id')
                ->where('prospectos.userid',auth::user()->id)
                ->whereYear('ventas.fecha', $ano)
                ->whereMonth('ventas.fecha', $mes)
                ->sum('ventas.monto');

            $usuario = auth::user();

            $avancemeta = round(($ventasmes/$usuario->meta)*100);

            $diasmes =Carbon::now()->daysInMonth;
            $numdia =Carbon::now()->day;

            //dd($numdia);

            $proyectado = round(($ventasmes*$diasmes/$numdia));
            $porcentajeproyectado = round(($proyectado/$usuario->meta)*100);

            if($porcentajeproyectado>90){
                $color='success';
            }elseif($porcentajeproyectado>60){
                $color = 'warning';
            }else{
                $color= 'danger';
            }

        	
        	//$prospectos = Prospecto::where('estatus','like','prospecto')->get();
        	
        	
        	return view('pages.dashboard', compact('etapas','prospectos','usuario','ventasmes','avancemeta','proyectado','porcentajeproyectado','color'));

        }else{
            $prospectos = Prospecto::where('estatus','like','prospecto')->get();
            return view('pages.dashboard', compact('etapas','prospectos'));
        }
    }
}
