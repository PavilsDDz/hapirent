<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class aboutus extends Controller
{
    public function index(){
    	$gal = db::table('galleries')->where('title_lv','par mums')->first();
    	return view('about.about',compact('gal'));
    }
}
