<?php

namespace App\Hellpers;

use Intervention\Image\ImageManagerStatic as Image;



class Hellper 
{
	public static function  randomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public static function imageResize($media,$width=700){

        $media_resize = Image::make($media->getRealPath());
        $media_resize->orientate();

		$h = $media_resize->height();
        $w = $media_resize->width();
		if ($w>$width || $h>$width) {
			if ($w>$h){
				$k = $width/$w;
		 	}else {
		    	$k = $width/$h;
		  	}
		}else{
		    $k=1;
		}
		$media_resize->resize($w*$k,$h*$k);

		return $media_resize;
	}
}