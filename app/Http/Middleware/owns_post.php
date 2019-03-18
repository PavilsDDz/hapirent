<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Post;
use DB;


class owns_post
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Auth::user()->id;
        // return $request->id;
         if(Auth::user()->id ==  DB::table('posts')->where('id',$request->id)->first()->user_id ){
            return $next($request);
             //return $next($request);
           
         }else{
            return redirect('/posts');

             //return redirect('/');
         }
            

         return dd($request);//$next($request);
    }
}
