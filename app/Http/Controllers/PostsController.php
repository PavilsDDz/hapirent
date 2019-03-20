<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Post;
use App\User;
use \Input as Input;
use Auth;
use DB;
use Session;
use View;
use Validator;



class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = DB::table('posts')->whereNull('deleted_at')->paginate(10);
       // return view('posts.index', compact('posts'));
        return view('posts.index');
    }
    public function getSnow(){
        $posts = DB::table('posts')->where('type', 0)->paginate(10);
        return view('posts.index', compact('posts'));
    }


    public function getWater(){
        $posts = DB::table('posts')->where('type', 1)->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function getSand(){
        $posts = DB::table('posts')->where('type', 2)->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function getAir(){
        $posts = DB::table('posts')->where('type', 3)->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request){
        //$posts = DB::table('posts')->where('type', 3)->paginate(10);
        //return dd($request);
        $search = array();
        $search['placeLoc'] = $request->placeLoc;
        $search['type'] = $request->type;
        return view('posts.index', compact('search'));
    }


    public function create(){
        
        return view('posts.create');
    }

    public function show($id){
        $post = Post::findOrFail($id);
        $post->prices = json_decode($post->prices);
        $post->media = json_decode($post->media);
        $author = User::findOrFail($post->user_id);
        
        $booked = session()->get('bookingRequested'); //Needs a redo with redirect()->withInputs from mailController 
        Session::forget('bookingRequested');
        // dd(session()->get('bookingRequested'));
        // $post->user_id
        //dd($postrpro);
        return view('posts.show',compact(['post','author','booked']));
    }

    public function edit($id){
        $post = DB::table('posts')->where('id',$id)->first();
        return view('posts.edit',compact('post'));
    }
    public function update($id, Request $request){
         //return dd($request);

        $post = Post::findOrFail($id);

        // return dd($post);
        $media_array = $request->file('media');
        $media_paths;
        $media_paths = json_decode($post->media);
        if($request->remove){
            $remove = json_decode($request->remove);
            foreach ($remove as $value) {
               unset($media_paths[$value]);
              $media_paths = array_values($media_paths);
            }
        // return dd($media_paths);
        }



        function store_img($original,$array,$replace){
            global $media_paths;
            $c=0;
            if (is_array($array)) {
                
                foreach ($array as $key => $media){
                  //$media_name    = $media->getClientOriginalName();
                    $media_resize = Image::make($media->getRealPath());
                    $media_thumb = Image::make($media->getRealPath());
                    $media_resize->orientate();
                    $media_thumb->orientate();
                    
                    $h = $media_resize->height();
                    $w = $media_resize->width();
                    $size = 1200;
                    $thumb_size = 150;
                    
                    if ($w>1200 || $h>1200) {
                        if ($w>$h){
                            $k = $size/$w;
                            $tk = $thumb_size/$w;
                        }else {
                            $k = $size/$h;
                            $tk = $thumb_size/$h;

                        }
                    }else{
                        $k=1;
                    }


                    $media_resize->resize($w*$k,$h*$k);
                    $media_thumb->resize($w*$tk,$h*$tk);

                    $thumb_name = time().'_'.$c.'_'.Auth::user()->id.'.'.$media->getClientOriginalExtension();
                    $media_name = time().'_'.$c.'_'.Auth::user()->id.'.'.$media->getClientOriginalExtension();
                    $media_resize->save(public_path('/images/').$media_name);
                    $media_thumb->save(public_path('/images/thumbs/').$thumb_name);

                    if (isset($replace[$key])) { //TO DO seit bildes tiek aizvietotas random 
                       $original[$replace[$key]] = $media_name;
                    }else{
                        array_push($original,$media_name);
                        
                    }
                    $c++;
                }
            }

            return $original;

        }
        $new_media_paths = store_img($media_paths,$media_array,json_decode($request->changed));
        //return dd($new_media_paths);

        $post->media = json_encode($new_media_paths);
        $post->name =  $request->name;
        $post->description =  $request->description;
        $post->prices =  $request->prices;
     //   $post->hour =  $request->hour;
       // $post->loc =  $request->loc;
        $post->lat = $post->lat;
        $post->lng = $post->lng;
        $post->save();
        // DB::table('posts')->where('id',$id)-
        return redirect('/posts/'.$id);
    }

    public function store(Request $request ){
        $validator = Validator::make($request->all(), [
            'lat'=> 'required',
            'lng'=> 'required',
            'name'=> 'required|min:2',
            'type'=> 'required',
            'prices'=> 'required',

        ]);
        // $request->flash();
          //dd(old());
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->input());
        }
       //return dd($request);
        $type = null;
        switch ($request->type) {
            
            case 'snow':
                $type = 0;
            break;

            case 'water':
                $type = 1;
            break;
            
            case 'ground':
                $type = 2;
            break;

            case 'air':
                $type = 3;
            break;
            
            default:
                $type = null;
             break;
        }
        $post = new Post;

        $post->user_id = Auth::user()->id;
        $post->name = $request->name;
        $post->description = $request->description;
        $post->type = $type;
        $post->lat = $request->lat;
        $post->lng = $request->lng;
        $post->prices = $request->prices;
     
            

       //  $media_path = [];
       //  if ($request->file('media')) {
       //      foreach($request->file('media') as $media) {
       //          $photo = $media->getClientOriginalName();
       //          $destination = public_path() . '/images/';
       //          $media->move($destination, $photo);
       //          array_push($media_path,url('/'). '/images/'.$photo);
       //      }
       //  }


       // $post->media = json_encode($media_path,JSON_UNESCAPED_SLASHES);

        $media_array = $request->file('media');
        // return dd($media_array);
        $c = 0;
        $media_paths = [];
        $size =1200;
        $thumb_size = 150;
        if(!empty($media_array) && count($media_array)>0){
            foreach ($media_array as $media){
                $ext = strtolower($media->getClientOriginalExtension());
                if (in_array($ext, array('jpg','jpeg','png'))) {
                    $media_name = $media->getClientOriginalName();
                    $media_resize = Image::make($media->getRealPath());
                    $media_thumb = Image::make($media->getRealPath());
                    $media_resize->orientate();
                    $media_thumb->orientate();
                    
                    $h = $media_resize->height();
                    $w = $media_resize->width();

                        if ($w>1200 || $h>1200) {
                            if ($w>$h){
                                $k = $size/$w;
                                $tk = $thumb_size/$w;
                            }else {
                                $k = $size/$h;
                                $tk = $thumb_size/$h;
                            }
                        }else{
                            $k = 1;
                            $tk = 1;
                        }
                        
                    $media_thumb->resize($w*$tk,$h*$tk);
                    $media_resize->resize($w*$k,$h*$k);
                    //$thumb_name = time().'_'.$c.'_'.Auth::user()->id.'.'.$media->getClientOriginalExtension();
                    $media_name = time().'_'.$c.'_'.Auth::user()->id.'.'.$media->getClientOriginalExtension();
                    $media_resize->save(public_path('/images/').$media_name);
                    $media_thumb->save(public_path('/images/thumbs/').$media_name);
                    array_push($media_paths,$media_name);
                    $c++;
                }
            }
        }else{
            $media_paths = array();
        }

        $post->media = json_encode($media_paths,JSON_UNESCAPED_SLASHES);


        $post->save();

        return redirect(url('/posts'));
    }


    public function query(Request $request){

        $posts = DB::table('posts')->whereNull('deleted_at');//->paginate(10);

        if (isset($request->type)&&!empty($request->type)) {
                switch ($request->type) {
                case 'snow':$type = 0;break;case 'water':$type = 1;break;case 'sand': $type = 2;break;case 'air':$type = 3;break;default:$type = null;break;
            }
           $posts = $posts -> where('type', '=', $type);
        }else{
           // return array('error'=>'nety');
        }


        if (isset($request->lat) && !empty($request->lat) && isset($request->lng) && !empty($request->lng)) {
           //  $text = 'sdsdsd';
           // return $text;
            //Latitude: 1 deg = 110.574 km
            //Longitude: 1 deg = 111.320*cos(latitude) km
            $radius = $request->radius ? $request->radius : 50;
            $latRad = $radius * 0.0090437;
            $lngRad = $radius * (1 / 111.320*cos($request->let));

            $latMax = floatval($request->lat + $latRad);
            $latMin = floatval($request->lat - $latRad);

            $lngMax = floatval($request->lng + $lngRad);
            $lngMin = floatval($request->lng - $lngRad);

            $posts = $posts -> where('lng','<',$lngMax)->where('lng','>',$lngMin)->where('lat','>',$latMin)->where('lat','<',$latMax);
        }
        
        if (isset($request->user_id)&&!empty($request->user_id)) {
            $posts->where('user_id','=',$request->user_id);
        }

        $posts = $posts ->orderBy('id','desc');
        if ($request->view == 'map') {
            $posts = $posts->get();
        }else{
            $page = isset($request->page) ? $request->page : 1;
            $perPage = isset($request->perPage) ? $request->perPage : 25;
            $posts = $posts->paginate($perPage, ['*'], 'page', $page);
            
        }

        foreach ($posts as $post) {
            if ($post->description) {
                $new_string = substr($post->description,0,rand(90,120)).'...';
                $post->description = $new_string;
            }
        }
      //  $posts->total = $posts->total();
        if($request->view == 'new'){
            return $posts;
        }else{
            $template = View::make('posts.post',array('jsTemlapate'=>true,'myPosts'=>$request->myPosts));
            $template = $template->render();
            $response = array(
                            'status' => 'success',
                            'posts' => $posts,
                            'template' => $template.``
                        );
            return response()->json($response);
        }
    }

    public function postsRequest (Request $request){
        return "test"; 
    }


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
};
