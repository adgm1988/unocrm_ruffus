<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    //
    public function prospectos(){
    	return $this->hasMany('App/Prospecto','procedencia');
    }
}
