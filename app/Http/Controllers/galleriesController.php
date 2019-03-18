<?php

namespace App\Http\Controllers;
use App\Gallery;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Response;

class galleriesController extends Controller
{
    public function index(){
        $galleries = db::table('galleries')->where('dependent',0)->orderBy('created_at', 'desc')->get();
        foreach ($galleries as $gal) {
            $gal->media = json_decode($gal->media);
        }
        return view('galleries.galleries',compact('galleries'));
    }
    public function create(){
        return view('galleries.create');
    }
    public function store(Request $request){
       //$string = dd($request);
        //return 'asdasd';

        $media_array = $request->file('media');
        $c = 0;
        $mediat_paths = [];
        foreach ($media_array as $media){
            $media_name    = $media->getClientOriginalName();
            $media_resize = Image::make($media->getRealPath());
            $h = $media_resize->height();
            $w = $media_resize->width();
            $size = 1200;
                if ($w>1200 || $h>1200) {
                    # code...
                    if ($w>$h){
                        $k = $size/$w;
                    }else {
                        $k = $size/$h;
                    }
                }else{
                    $k=1;
                }
            $media_resize->resize($w*$k,$h*$k);
            $media_name = time().'_'.$c.'_'.Auth::user()->id.'.'.$media->getClientOriginalExtension();
            $media_resize->save(str_replace('public/', '', public_path('uploads/imgs/')).$media_name);
            //return str_replace('public/', '', public_path('uploads/imgs')).$media_name;
            array_push($mediat_paths,$media_name);
            $c++;
        }

        if ($request->dependent=='on'){
            $dependent = 1;
        }else{
            $dependent = 0;
        }

        $gallery = new Gallery;
        $gallery->title_lv = $request->title_lv;
        $gallery->title_ru = $request->title_ru;
        $gallery->description_lv = $request->gallery_description_lv;
        $gallery->description_ru = $request->gallery_description_ru;
        $gallery->media = json_encode($mediat_paths,JSON_UNESCAPED_SLASHES);
        $gallery->media_description = json_encode(array('lv'=>$request->description_lv,'ru'=>$request->description_ru),JSON_UNESCAPED_SLASHES);
        $gallery->dependent = $dependent;
        $gallery->save();

        if ($request->ajax){
            return response()->json(array('success' => true, 'last_insert_id' => $gallery->id,'media'=>$mediat_paths[0]), 200);//(array('success' => true, 'last_insert_id' => $data->id), 200);

        }else{
            return redirect('/galleries/admin');
        }
    }

    public function ajax(Request $request){
        $gal = db::table('galleries')->where('id',$request->id)->first();

        return response()->json($gal);
    }
    public function edit($id){
        $gal = db::table('galleries')->where('id',$id)->first();

        return view('galleries.gallery_edit',compact('gal'));
        //return dd($gal);
    }
    public function update(Request $request){
        //return dd($request);
        $gallery = Gallery::findOrFail($request->id);


        $media_array = $request->file('media');
        global $mediat_paths;
        $mediat_paths = json_decode($gallery->media);
        if($request->remove){
            $remove = json_decode($request->remove);
            foreach ($remove as $value) {
               unset($mediat_paths[$value]);
              $mediat_paths = array_values($mediat_paths);
            }
        }
        $c = 0;

        function store_img($array,$replace){
            global $c;
            global $mediat_paths;
           //return dd($mediat_paths);
            foreach ($array as $key => $media){
              //  $media_name    = $media->getClientOriginalName();
                $media_resize = Image::make($media->getRealPath());
                $media_resize->orientate();
                
                $h = $media_resize->height();
                $w = $media_resize->width();
                $size = 1200;
                if ($w>1200 || $h>1200) {
                    # code...
                    if ($w>$h){
                        $k = $size/$w;
                    }else {
                        $k = $size/$h;
                    }
                }else{
                    $k=1;
                }
                $media_resize->resize($w*$k,$h*$k);
                $media_name = time().'_'.$c.'_'.Auth::user()->id.'.'.$media->getClientOriginalExtension();
                $media_resize->save('uploads/imgs/'.$media_name);
                if ($replace) {
                   $mediat_paths[$key] = $media_name;
                }else{
                    array_push($mediat_paths,$media_name);
                }
                $c++;
            }

        }
            if ($request->dependent=='on'){
                $dependent = 1;
            }else{
                $dependent = 0;
            }

        if ($request->file('media_replace')) {
            store_img($request->file('media_replace'),1);
        }
        if ($request->file('media')) {
            store_img($request->file('media'),0);
        }




        $gallery->title_lv = $request->title_lv;
        $gallery->title_ru = $request->title_ru;
        $gallery->description_lv = $request->gallery_description_lv;
        $gallery->description_ru = $request->gallery_description_ru;
        $gallery->media = json_encode($mediat_paths,JSON_UNESCAPED_SLASHES);
        $gallery->media_description = json_encode(array('lv'=>$request->description_lv,'ru'=>$request->description_ru),JSON_UNESCAPED_SLASHES);
        $gallery->dependent = $dependent;
       $gallery->save();

       return redirect('/galleries/admin');
        //return dd($mediat_paths);
    }

    public function admin(){
        $galleries = db::table('galleries')->orderBy('created_at', 'desc')->get();
        return view('galleries.admin', compact('galleries'));
    }



}
