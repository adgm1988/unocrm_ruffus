<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    //
    public function prospectos(){
    	return $this->hasMany('App\Prospecto');
    }
    
}
