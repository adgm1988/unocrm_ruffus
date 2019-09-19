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
    	return view('pages.reports',compact('etapas','tipoacts','prospectos','vendedores'));
    }
}
