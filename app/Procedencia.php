<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedencia extends Model
{
    //
    public function prospectos(){
    	return $this->hasMany('App/Prospecto','procedencia');
    }
}
