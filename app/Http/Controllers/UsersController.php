<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    function index(){
		$users = User::all();
		return view('pages.users',compact('users'));
	}
}
