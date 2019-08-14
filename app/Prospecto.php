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
		return $this->belongsTo('App\Etapa','etapa');
	}

	public function user(){
		return $this->belongsTo('App\User','userid');
	}

	public function actividades(){
		return $this->hasMany('App\Actividad','_prospectoid')->orderBy('fecha', 'DESC');
	}

	public function getSemaforoAttribute(){
		$siguiente_act = $this->actividades->where('resultado','=','')->first();
		
		if($siguiente_act!=''){
			$fecha_sig_act = $siguiente_act->fecha;
		}else{
			$fecha_sig_act = null;
		}

		if($fecha_sig_act == null){
			return "gray";
		}elseif ($fecha_sig_act < date('Y-m-d')){
			return "red";
		}else{
			return "green";
		}
	}
}
