<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\Etapa;

class DashboardController extends Controller
{
    //
    function index(){
    	//$etapas = Etapa::all();
    	$etapas = Etapa::withCount('prospectos')->get(); //on esto ya saco la cantidad de propsectos por etapa

    	$etapas = $etapas->sortBy('orden');
    	$prospectos = Prospecto::all();
    	
    	return view('pages.dashboard', compact('etapas','prospectos'));
    }
}
