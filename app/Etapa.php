<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    //
    public function prospectos(){
    	return $this->hasMany('App\Prospecto');
    }

    public function getSumaAttribute(){
    	return $this->prospectos()->where('estatus','like','prospecto')->sum('valor');
    }
    
    public function getCuentaAttribute(){
    	return $this->prospectos()->where('estatus','like','prospecto')->count('id');
    }
}
