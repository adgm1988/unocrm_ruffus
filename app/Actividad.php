<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //

    public function tiposdeact(){
    	return $this->belongsTo('App\Tipoact','_tipoactid');
    }

    public function prospecto(){
    	return $this->belongsTo('App\Prospecto','_prospectoid');
    }

    public function creadopor(){
        return $this->belongsTo('App\User','created_by');
    }

    public function editadopor(){
        return $this->belongsTo('App\User','edited_by');
    }

    public function getColorAttribute(){
    	
    	
    	if ($this->realizada == 1 ){
    		return $this->tiposdeact->color_realizada;
    	}else{
    		return $this->tiposdeact->color;
    	}
    	
    }

    public function getSemaforoAttribute(){
        $fecha = $this->fecha;
        $realizada = $this->resultado ? 1: 0;

        if($realizada === 1){
            return "#C4C4C4"; //gris
        }elseif($fecha < date('Y-m-d')){
            return "#FF0C00"; //rojo
        }else{
            return "#40CA00"; //verde
        }   

    }
}
