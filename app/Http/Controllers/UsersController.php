<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    function index(){
		$users = User::all();
		return view('pages.users',compact('users'));
	}

	function store(Request $request){
		$validatedData = $request->validate([
	        'name' => 'required',
	        'email' => 'required',
    	]);

    	$usuario = new User;
    	$usuario->name = $request->get('name');
    	$usuario->email = $request->get('email');
        if($request->get('password')){
            $usuario->password = Hash::make($request->get('password'));
        }
    	$usuario->admin = $request->get('admin') ? 1 : 0;
    	$usuario->consultor = $request->get('consultor') ? 1 : 0;
    	$usuario->director = $request->get('director') ? 1 : 0;
    	$usuario->vendedor = $request->get('vendedor') ? 1 : 0;

    	$usuario->save();

         return redirect('/users');
		
	}

	function update(Request $request, $id){
		$validatedData = $request->validate([
	        'name' => 'required',
	        'email' => 'required|email|unique:users,email,'.$id,
    	]);

    	$usuario = User::find($id);
    	$usuario->name = $request->get('name');
    	$usuario->email = $request->get('email');
    	if($request->get('password')){
            $usuario->password = Hash::make($request->get('password'));
        }
    	$usuario->admin = $request->get('admin') ? 1 : 0;
    	$usuario->consultor = $request->get('consultor') ? 1 : 0;
    	$usuario->director = $request->get('director') ? 1 : 0;
    	$usuario->vendedor = $request->get('vendedor') ? 1 : 0;

    	$usuario->save();

        return redirect('/users');

	}

	function destroy($id){
    	$usuario = User::find($id);

    	$usuario->delete();

        return redirect()->back();
    }
}
