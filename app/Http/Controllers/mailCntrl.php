<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\bookMail;
use App\Post;
use Mail;
use Auth;
use Lang;
use Session;
use Validator;
// use Redirect;
// use Input;



class mailCntrl extends Controller
{
    public function sendBooking(Request $request){
    	$post = Post::find($request->post);

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

        Mail::send(new bookMail($request,$post));
        $message = str_replace([':postName',':time'],[$post->name, $request->date.' '.$request->hours.':'.$request->minutes], Lang::get('messages.booking_requested'));
        //return redirect('posts/'.$post->id);
    	session()->put('bookingRequested', $message);
		return redirect('/posts/'.$post->id);
    }
}