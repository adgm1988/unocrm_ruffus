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
		return $this->hasMany('App\Bitacora','prospecto_id')->orderBy('fecha', 'ASC');
	}

	public function ventas(){
		return $this->hasMany('App\Venta','_prospectoid')->orderBy('fecha', 'DESC');
	}

	public function getHijosAttribute(){
		return $this->actividades()->count() + $this->ventas()->count();
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
		$ultima_bitacora = $this->bitacoras->first();
		if($ultima_bitacora){
			$ultimo_cambio = $ultima_bitacora->created_at;
			$ultimo_estatus_dias = $ultima_bitacora->etapa->dias;

			$dias=$ultimo_cambio->diffInDays();
			$dias_por_vencer = $ultimo_estatus_dias - $dias;

			if($dias_por_vencer<0){
				return '#ffc0b8'; //color rojo;
			}elseif($dias_por_vencer<2){
				return "#fff8b0"; // color amarillo;
			}else{
				return 'white';
			}
		}else{
			return 'white';
		}
		
	}

	public function getDiasAttribute(){
		
		$ultima_bitacora = $this->bitacoras->first();
		if($ultima_bitacora){
			$ultimo_cambio = $ultima_bitacora->created_at;
			$ultimo_estatus_dias = $ultima_bitacora->etapa->dias;

			$dias=$ultimo_cambio->diffInDays();
			$dias_por_vencer = $ultimo_estatus_dias - $dias;
			if($dias_por_vencer<5){
				return "(".$dias_por_vencer.")";
			}else{
				return "";
			}
		}else{
			return "";
		}
	}


}
