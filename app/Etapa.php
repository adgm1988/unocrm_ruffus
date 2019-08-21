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
    	return $this->prospectos()->sum('valor');
    }
    
}
