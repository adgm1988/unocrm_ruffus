<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etapa;
use App\Tipoact;
use App\Procedencia;

class ConfigController extends Controller
{
    function index(){
    	$etapas = Etapa::all();
    	$etapas = $etapas->sortBy('orden');

    	$tipos = Tipoact::all();
    	$tipos = $tipos->sortBy('orden');

    	$procedencias = Procedencia::all();
    	$procedencias = $procedencias->sortBy('orden');


		return view('pages.config',compact('etapas','tipos','procedencias'));
    }
}
