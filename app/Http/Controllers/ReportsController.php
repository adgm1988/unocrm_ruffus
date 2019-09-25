<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\User;
use App\Procedencia;
use App\Industry;
use App\Etapa;
use App\Tipoact;
use DB;


class ReportsController extends Controller
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



    	return view('pages.reports',compact('etapas','tipoacts','prospectos_cant','clientes_cant','perdidos_cant','prospectos_val','clientes_val','perdidos_val','vendedores','user','desde','hasta'));
    }

    public function filtrar(Request $request){

    	$user = $request->get('vendedor');
    	$desde = $request->get('desde');
    	$hasta = $request->get('hasta');

        $etapas = Etapa::orderBy('orden')->get();


    	if($user == 0){
    		$prospectos_cant = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                    ->where('estatus', 'prospecto')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta) 
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

             $clientes_cant = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                    ->where('estatus', 'cliente')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)  
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

            $perdidos_cant = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                    ->where('estatus', 'perdido')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)  
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

                    //MONTOS
            $prospectos_val = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                    ->where('estatus', 'prospecto')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta) 
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

             $clientes_val = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                    ->where('estatus', 'cliente')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)  
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

            $perdidos_val = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                    ->where('estatus', 'perdido')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)  
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

    	}else{
            $prospectos_cant = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                    ->where('userid', $user)
                    ->where('estatus', 'prospecto')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta) 
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

             $clientes_cant = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                    ->where('userid', $user)
                    ->where('estatus', 'cliente')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)  
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

            $perdidos_cant = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('count(*) as cantidad, etapas.etapa AS etapa'))
                    ->where('userid', $user)
                    ->where('estatus', 'perdido')
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)  
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

    		$prospectos_val = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                    ->where('estatus', 'prospecto') 
                    ->where('userid', $user)
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)  
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

             $clientes_val = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                    ->where('estatus', 'cliente')
                    ->where('userid', $user)
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)   
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();

            $perdidos_val = DB::table('prospectos')
                    ->join('etapas', 'etapas.id', '=', 'prospectos.etapa_id')
                    ->select(DB::raw('sum(valor) as suma, etapas.etapa AS etapa'))
                    ->where('estatus', 'perdido')
                    ->where('userid', $user)
                    ->where('prospectos.created_at', '>=', $desde) 
                    ->where('prospectos.created_at', '<=', $hasta)   
                    ->groupBy('etapa')
                    ->orderBy('etapas.orden')
                    ->get();
    	}

    	$tipoacts= Tipoact::all();
    	$vendedores= User::where('vendedor',1)->get();

        /*$prospectos_dias = DB::table('prospectos')
                    ->select(DB::raw('sum(valor) as prom, etapa_id'))
                    ->groupBy('etapa_id')
                    ->orderBy('etapa_id')
                    ->get();

        dd($prospectos_dias);
        */
        
    	return view('pages.reports',compact('etapas','tipoacts','prospectos_cant','clientes_cant','perdidos_cant','prospectos_val','clientes_val','perdidos_val','vendedores','user','desde','hasta'));
    }


}


