<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Programm;



class contact extends Controller
{
    public function index(){
    	$prg = db::table('programms')->get(['title_lv','title_ru','id']);
    	return view('contact.contact',compact('prg'));
    }
    public function send(Request $request){
    	return dd($request);
    }
}
