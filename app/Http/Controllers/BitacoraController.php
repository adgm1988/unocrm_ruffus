<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;

class BitacoraController extends Controller
{
    //
    public function index(){
    	$bitacoras = Bitacora::all();

    	return view('pages.bitacoras', compact('bitacoras'));
    }
}
