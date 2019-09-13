<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\Etapa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    function index(){
        if(auth::user()->vendedor == 1){
            $prospectos = Prospecto::where('estatus','like','prospecto')->where('userid',auth::user()->id)->get();
        }else{
            $prospectos = Prospecto::where('estatus','like','prospecto')->get();
        }


    	//$etapas = Etapa::all();
    	$etapas = Etapa::withCount('prospectos')->get(); //on esto ya saco la cantidad de propsectos por etapa

    	$etapas = $etapas->sortBy('orden');
    	//$prospectos = Prospecto::where('estatus','like','prospecto')->get();
    	
    	
    	return view('pages.dashboard', compact('etapas','prospectos'));
    }
}
