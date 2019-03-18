<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class TestController extends Controller
{
    public function form(){
    	return view('form');
    }
    public function formGet(Request $request){

    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);
    	// $request->flash();
    	  //dd(old());
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->input());
        }
        return "succes";
    }
}
