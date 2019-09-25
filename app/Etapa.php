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

    public function getCuentaperdidosAttribute(){
        return $this->prospectos()->where('estatus','like','perdido')->count('id');
    }

    public function getSumaperdidosAttribute(){
        return $this->prospectos()->where('estatus','like','perdido')->sum('valor');
    }

    public function getCuentaclientesAttribute(){
        return $this->prospectos()->where('estatus','like','cliente')->count('id');
    }

    public function getSumaclientesAttribute(){
        return $this->prospectos()->where('estatus','like','cliente')->sum('valor');
    }

    public function getDiasetapaAttribute(){
        //return $this->prospectos()->avg('dias');
        return 50;
    }


}
