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

class ProspectoController extends Controller
{
    //
	function index(){
		$prospectos = Prospecto::where('estatus','prospecto')->paginate(30);
        $cant = Prospecto::where('estatus','prospecto')->count();
        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        $filtro='';
		return view('pages.prospectos',compact('prospectos','procedencias','etapas','industrias','filtro','cant'));
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
                $prospectos = Prospecto::where($campo,'like','%'.$valor.'%')->paginate(30);
                $cant = Prospecto::where($campo,'like','%'.$valor.'%')->count();
                $condicion_texto= "contiene";
                break;
            case "mayor":  // if $var == "y"
                $prospectos = Prospecto::where($campo,'>',$valor)->paginate(30);
                $cant = Prospecto::where($campo,'>',$valor)->count();
                $condicion_texto= "es mayor que";
                break;
            case "menor":  // if $var == "y"
                $prospectos = Prospecto::where($campo,'<',$valor)->paginate(30);
                $cant = Prospecto::where($campo,'<',$valor)->xount();
                $condicion_texto= "es menor que";
                break;
            case "especial":  // if $var == "y"
                $prospectos = Prospecto::whereIn($campo_tabla, $array_ids)->paginate(30);   
                $cant = Prospecto::whereIn($campo_tabla, $array_ids)->count();   
                $condicion_texto= "contiene";
                break;
            default:  // if $var != "x" && != "y"
                $prospectos = Prospecto::paginate(30);
                $cant = Prospecto::all()->count();
                break;
       }

        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        $filtro = ucfirst($campo)." ".$condicion_texto." ". $valor;
        return view('pages.prospectos',compact('prospectos','procedencias','etapas','industrias','filtro','cant'));
    }

    function store(Request $request)
    {

    	$validatedData = $request->validate([
	        'empresa' => 'required',
	        'contacto' => 'required',
	        'telefono' => 'required',
	        'correo' => 'required',
	        'procedencia' => 'required',
            'industria' => 'required',
	        'valor' => 'required',
            'etapa' => 'required',
            'estatus' => 'prospecto',

    	]);


    	//aqui hay error porque no paso la info vlaidada

    	$prospecto = new Prospecto;
    	$prospecto->empresa = $request->get('empresa');
    	$prospecto->contacto = $request->get('contacto');
    	$prospecto->telefono = $request->get('telefono');
    	$prospecto->correo = $request->get('correo');
    	$prospecto->procedencia = $request->get('procedencia');
        $prospecto->industria = $request->get('industria');
        $prospecto->etapa_id = $request->get('etapa');
    	$prospecto->valor = $request->get('valor');    
        $prospecto->estatus = 'prospecto';    
        $prospecto->userid = auth()->user()->id;

    	$prospecto->save();

        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = Carbon::now();
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = "Creacion prospecto";
        $bitacora->etapa_id = $request->get('etapa');

        $bitacora->save();

         return redirect('/prospectos/'.$prospecto->id);



    }

    function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'empresa' => 'required',
            'contacto' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'procedencia' => 'required',
            'industria' => 'required',
            'valor' => 'required',
            'etapa' => 'required',
            'estatus' => 'required',
        ]);



        //aqui hay error porque no paso la info vlaidada

        $prospecto = Prospecto::find($id);
        $prospecto->empresa = $request->get('empresa');
        $prospecto->contacto = $request->get('contacto');
        $prospecto->telefono = $request->get('telefono');
        $prospecto->correo = $request->get('correo');
        $prospecto->procedencia = $request->get('procedencia');
        $prospecto->industria = $request->get('industria');
        $prospecto->etapa_id = $request->get('etapa');
        $prospecto->valor = $request->get('valor');
        $prospecto->estatus = $request->get('estatus');
        $prospecto->userid = auth()->user()->id;

        $prospecto->save();

        /**
        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->tipo = "Edicion de prospecto";
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = "Se edito la información general del prospecto";


        $bitacora->save();
        **/

        $tipos = Tipoact::all();
        $etapas = Etapa::all();
        return view ('pages.prospecto_reg',compact('prospecto','tipos','etapas'));
    }

    function form($id){
        $prospecto = Prospecto::find($id);
        $procedencias = Procedencia::all();
        $etapas = Etapa::all();
        $industrias = Industry::all();
        return view('pages.prospecto_edit',compact('prospecto','procedencias','etapas','industrias'));
    }

    function perdido($id){
        $prospecto = Prospecto::find($id);
        return view('pages.perdido',compact('prospecto'));
    }

    function updateperdido(Request $request, $id){
        $prospecto = Prospecto::find($id);
        $validatedData = $request->validate([
            'motivo' => 'required',
        ]);
        
        $prospecto->estatus = "perdido";
        $prospecto->userid = auth()->user()->id;
        $prospecto->save();

        $bitacora_anterior = Bitacora::where('prospecto_id',$id)->latest()->first();
        if($bitacora_anterior){
            $fechaanterior = Carbon::createFromDate($bitacora_anterior->fecha);
            $dias = $fechaanterior->diffInDays(Carbon::now());
            $bitacora_anterior->dias = $dias;
            $bitacora_anterior->save();

        }else{
            $fechaanterior = $prospecto->created_at;
            $dias = $fechaanterior->diffInDays(Carbon::now());

            $bitacora = new Bitacora;            
            $bitacora->prospecto_id = $prospecto->id;
            $bitacora->fecha = $prospecto->created_at;
            $bitacora->user_id = auth()->user()->id;
            $bitacora->nota = "Creacion prospecto";
            $bitacora->dias = $dias;
            $bitacora->etapa_id = $request->get('etapa_anterior_id');

            $bitacora->save();
        }

        
        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = Carbon::now();
        $bitacora->user_id = auth()->user()->id;
        $bitacora->dias = $dias;
        $bitacora->nota = "Prospecto perdido por ".$request->get('motivo').": " .$request->get('notas');
        $bitacora->etapa_anterior_id = $request->get('etapa_anterior_id');
        $bitacora->etapa_id = $request->get('etapa_anterior_id');

        $bitacora->save();

        return redirect("/prospectos/".$prospecto->id);

    }

    function ganado($id){
        $prospecto = Prospecto::find($id);
        return view('pages.ganado',compact('prospecto'));
    }

    function updateganado(Request $request, $id){
        $prospecto = Prospecto::find($id);
        $validatedData = $request->validate([
            'valor' => 'required',
        ]);
        
        $prospecto->estatus = "ganado";
        $prospecto->userid = auth()->user()->id;
        $prospecto->save();

        $bitacora_anterior = Bitacora::where('prospecto_id',$id)->latest()->first();
        if($bitacora_anterior){
            $fechaanterior = Carbon::createFromDate($bitacora_anterior->fecha);
            $dias = $fechaanterior->diffInDays(Carbon::now());
            $bitacora_anterior->dias = $dias;
            $bitacora_anterior->save();

        }else{
            $fechaanterior = $prospecto->created_at;
            $dias = $fechaanterior->diffInDays(Carbon::now());

            $bitacora = new Bitacora;            
            $bitacora->prospecto_id = $prospecto->id;
            $bitacora->fecha = $prospecto->created_at;
            $bitacora->user_id = auth()->user()->id;
            $bitacora->nota = "Creacion prospecto";
            $bitacora->dias = $dias;
            $bitacora->etapa_id = $request->get('etapa_anterior_id');

            $bitacora->save();
        }

        
        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = Carbon::now();
        $bitacora->user_id = auth()->user()->id;
        $bitacora->dias = $dias;
        $bitacora->nota = "Prospecto perdido por ".$request->get('valor').": " .$request->get('notas');
        $bitacora->etapa_anterior_id = $request->get('etapa_anterior_id');
        $bitacora->etapa_id = $request->get('etapa_anterior_id');

        $bitacora->save();

        return redirect("/prospectos/".$prospecto->id);

    }

    function destroy($id){
    	$prospecto = Prospecto::find($id);
        $procedencias = Procedencia::all();

    	$prospecto->delete();

    	$prospectos = Prospecto::all();

    	return redirect('prospectos');
    }

    function show($id){
        $prospecto = Prospecto::find($id);
        $tipos = Tipoact::all();
        $etapas = Etapa::all();
        return view ('pages.prospecto_reg',compact('prospecto','tipos','etapas'));
    }

    function destroyact($id){
        $actividad = Actividad::find($id);
        $actividad->delete();
        return back();
    }

    function cambioetapa($id, Request $request){
        
        $prospecto = Prospecto::find($id);
        $prospecto->etapa_id = $request->get('etapa');
        $prospecto->save();

        $bitacora_anterior = Bitacora::where('prospecto_id',$id)->latest()->first();
        if($bitacora_anterior){
            $fechaanterior = Carbon::createFromDate($bitacora_anterior->fecha);
            $dias = $fechaanterior->diffInDays(Carbon::now());
            $bitacora_anterior->dias = $dias;
            $bitacora_anterior->save();

        }else{
            $fechaanterior = $prospecto->created_at;
            $dias = $fechaanterior->diffInDays(Carbon::now());

            $bitacora = new Bitacora;            
            $bitacora->prospecto_id = $prospecto->id;
            $bitacora->fecha = $prospecto->created_at;
            $bitacora->user_id = auth()->user()->id;
            $bitacora->nota = "Creacion prospecto";
            $bitacora->dias = $dias;
            $bitacora->etapa_id = $request->get('etapa_anterior_id');

            $bitacora->save();
        }

        
        $bitacora = new Bitacora;
        $bitacora->prospecto_id = $prospecto->id;
        $bitacora->fecha = Carbon::now();
        $bitacora->user_id = auth()->user()->id;
        $bitacora->nota = "Cambio de etapa";
        $bitacora->etapa_id = $request->get('etapa');
        $bitacora->etapa_anterior_id = $request->get('etapa_anterior_id');

        $bitacora->save();

         return redirect('/prospectos/'.$id);
    }

}
