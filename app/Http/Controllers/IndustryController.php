<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;

class IndustryController extends Controller
{
    //
    function index(){
        $industrias = Industry::all();
        $industrias = $industrias->sortBy('orden');

        return view('catalogos.industrias',compact('industrias'));
    }

    function store(Request $request){
    	$validated = $request->validate([
    		'industria'=> 'required',
    		'orden'=> 'required',
    	]);

    	$industria = new Industry;
    	$industria->industria = $request->get('industria');
    	$industria->orden = $request->get('orden');
    	//dd($industria);

    	$industria->save();

    	return redirect()->back();

    }

    function update(Request $request, $id){
        $validated = $request->validate([
            'industria'=> 'required',
            'orden'=> 'required',
        ]);

        $industria = Industry::find($id);
        $industria->industria = $request->get('industria');
        $industria->orden = $request->get('orden');
        //dd($industria);

        $industria->save();

        return redirect('/industrias');

    }

    function form($id){
        $industria = Industry::find($id);
        return view('pages.industria_edit', compact('industria'));
    }

    function destroy($id){
    	$industria = Industry::find($id);

    	$industria->delete();

    	return redirect()->back();

    }
}
