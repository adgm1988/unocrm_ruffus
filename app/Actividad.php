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

    public function getColorAttribute(){
    	
    	
    	if ($this->resultado != ""){
    		return $this->tiposdeact->color_realizada;
    	}else{
    		return $this->tiposdeact->color;
    	}
    	
    }
}
