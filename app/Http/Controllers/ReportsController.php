<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\User;
use App\Procedencia;
use App\Industry;
use App\Etapa;
use App\Tipoact;


class ReportsController extends Controller
{
    public function index(){
    	$etapas = Etapa::all();
    	$tipoacts= Tipoact::all();
    	$prospectos= Prospecto::all();
    	$vendedores= User::where('vendedor',1)->get();
        $user = 0;
        $desde ='';
        $hasta = '';
    	return view('pages.reports',compact('etapas','tipoacts','prospectos','vendedores','user','desde','hasta'));
    }

    public function filtrar(Request $request){

    	$user = $request->get('vendedor');
    	$desde = $request->get('desde');
    	$hasta = $request->get('hasta');

    	$etapas = Etapa::all();
    	if($user == 0){
    		$prospectos= Prospecto::all();
    	}else{
    		$prospectos = Prospecto::where('userid','like',$user)->get();
    	}
    	$tipoacts= Tipoact::all();
    	$vendedores= User::where('vendedor',1)->get();
    	return view('pages.reports',compact('etapas','tipoacts','prospectos','vendedores','user','desde','hasta'));
    }


}
