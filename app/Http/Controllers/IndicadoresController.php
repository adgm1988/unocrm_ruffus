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



    	return view('pages.indicadores',compact('etapas','tipoacts','prospectos_cant','clientes_cant','perdidos_cant','prospectos_val','clientes_val','perdidos_val','vendedores','user','desde','hasta'));
    }
}
