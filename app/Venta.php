<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    public function prospecto(){
		return $this->belongsTo('App\Prospecto','_prospectoid');
	}
	
}
