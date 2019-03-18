<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Hellpers\Hellper;
use Illuminate\Support\Facades\Hash;
// use App\Post;
use App\Post;
use App\User;
use Auth;
use \Input as Input;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->image==null){
            $user->image = url('/').'/images/avatar.jpg';
        }
        $posts = DB::table('posts')->where('user_id','=',$user->id)->get();
        $myProfile = true;
    	return view('profile.profile',compact(['user','posts','myProfile']));
    }
    public function showUser($id){
        $user = User::findOrFail($id);
        $posts = Post::where('user_id',$id)->get();
        return view('profile.profile',compact(['user','posts']));
    }
    public function edit(){
        $user = Auth::user();
//        if($user->image==null){
//            $user->image = url('/').'/images/avatar.jpg';
//        }
        return view('profile.edit',compact('user'));
    }
    public function update(Request $request){

        $id = Auth::user()->id;

        $user = User::findOrFail($id);
        $user->name =  $request->name;
        $user->email = $request->email;
        $user->regNumber = $request->regNumber;

        if ($request->file('image')) {

                $image = $request->file('image');
                $media_resize=Hellper::imageResize($image,500);
                $media_name = time().'_'.$id;//$image->getClientOriginalName();
                $media_resize->save(public_path('/images/users/').$media_name);

                $user->image = url('/'). '/images/users/'.$media_name;
        }

        //dd([Hash::make($request->passwordOld), $user->password]);

        if (!empty($request->passwordNew1) && !empty($request->passwordNew2)) {


            if(Hash::check($request->passwordOld, $user->password)){   
                if ($request->passwordNew1 == $request->passwordNew2) { 
                    $user->password = Hash::make($request->passwordNew1);
                }else{
                    echo "no match";
                    die();
                }
            }else{
                echo "inncoret";
                die();
            }
        }else{
            echo "empty";
            die();
        }

        $user->save();

        // DB::table('posts')->where('id',$id)-
        return redirect('/profile');
    }

}