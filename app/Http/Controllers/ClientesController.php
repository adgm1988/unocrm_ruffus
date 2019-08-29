<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospecto;
use App\Procedencia;
use App\Etapa;
use App\Actividad;
use App\Tipoact;
use App\Industry;
use App\Bitacora;
use App\User;
use Carbon\Carbon;

class ClientesController extends Controller
{
    function index(){
		$prospectos = Prospecto::where('estatus','like','cliente')->paginate(30);
        $cant = Prospecto::where('estatus','like','cliente')->count();
        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        $filtro='';
		return view('pages.prospectos_clientes',compact('prospectos','procedencias','etapas','industrias','filtro','cant'));
	}

    function search(Request $request){
        $campo = $request->get('campo');
        $valor = $request->get('valor');
        $condicion = $request->get('condicion');

        switch ($campo){
            case "industria":  // if $var == "x"
                $registros = Industry::where('industria','like','%'.$valor.'%')->get();
                //dd($industrias);
                $array_ids = array();
                foreach ($registros as $registro){
                    array_push($array_ids, $registro->id);
                }
                $condicion = "especial";
                $campo_tabla = "industria";
                break;
            case "etapa":  // if $var == "x"
                $registros = Etapa::where('etapa','like','%'.$valor.'%')->get();
                //dd($industrias);
                $array_ids = array();
                foreach ($registros as $registro){
                    array_push($array_ids, $registro->id);
                }
                $condicion = "especial";
                $campo_tabla = "etapa_id";
                break;
            case "procedencia":  // if $var == "x"
                $registros = Procedencia::where('procedencia','like','%'.$valor.'%')->get();
                //dd($industrias);
                $array_ids = array();
                foreach ($registros as $registro){
                    array_push($array_ids, $registro->id);
                }
                $condicion = "especial";
                $campo_tabla = "procedencia";
                break;
            case "usuario":  // if $var == "x"
                $registros = User::where('name','like','%'.$valor.'%')->get();
                //dd($industrias);
                $array_ids = array();
                foreach ($registros as $registro){
                    array_push($array_ids, $registro->id);
                }
                $condicion = "especial";
                $campo_tabla = "userid";
                break;
                
            default:  // if $var != "x" && != "y"
                $campo = $request->get('campo');
                break;
       }



        switch ($condicion){
            case "contiene":  // if $var == "x"
                $prospectos = Prospecto::where('estatus','like','cliente')->where($campo,'like','%'.$valor.'%')->paginate(30);
                $condicion_texto= "contiene";
                break;
            case "mayor":  // if $var == "y"
                $prospectos = Prospecto::where('estatus','like','cliente')->where($campo,'>',$valor)->paginate(30);
                $condicion_texto= "es mayor que";
                break;
            case "menor":  // if $var == "y"
                $prospectos = Prospecto::where('estatus','like','cliente')->where($campo,'<',$valor)->paginate(30);
                $condicion_texto= "es menor que";
                break;
            case "especial":  // if $var == "y"
                $prospectos = Prospecto::where('estatus','like','cliente')->whereIn($campo_tabla, $array_ids)->paginate(30);   
                $condicion_texto= "contiene";
                break;
            default:  // if $var != "x" && != "y"
                $prospectos = Prospecto::paginate(30);
                break;
       }

        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        $filtro = ucfirst($campo)." ".$condicion_texto." ". $valor;
        return view('pages.prospectos_clientes',compact('prospectos','procedencias','etapas','industrias','filtro'));
    }
}
