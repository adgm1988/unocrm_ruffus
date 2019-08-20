<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    //
    public function procedencias()
	{
	    return $this->belongsTo('App\Procedencia', 'procedencia');
	}
	 public function industrias()
	{
	    return $this->belongsTo('App\Industry', 'industria');
	}

	public function etapas(){
		return $this->belongsTo('App\Etapa','etapa_id');
	}

	public function user(){
		return $this->belongsTo('App\User','userid');
	}

	public function actividades(){
		return $this->hasMany('App\Actividad','_prospectoid')->orderBy('fecha', 'DESC');
	}

	public function bitacoras(){
		return $this->hasMany('App\Bitacora','prospecto_id')->orderBy('fecha', 'DESC');
	}

	public function getSemaforoAttribute(){
		$siguiente_act = $this->actividades->where('resultado','=','')->first();
		
		if($siguiente_act!=''){
			$fecha_sig_act = $siguiente_act->fecha;
		}else{
			$fecha_sig_act = null;
		}

		if($fecha_sig_act == null){
			return "#C4C4C4"; //gris
		}elseif ($fecha_sig_act < date('Y-m-d')){
			return "#FF0C00"; //rojo
		}else{
			return "#40CA00"; //verde
		}
	}

	public function getIndicadorAttribute(){
		return "red"; //aqui es un color dependiente de cuanto tiempo lleva el prospecto en alguna etapa
	}
}
