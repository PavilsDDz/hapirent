<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;
    protected $fillable = ['title_lv','title_ru','description_lv','description_ru',];
    protected $casts = ['media','media_descriptions'];


}

