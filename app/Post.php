<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;


class Post extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'user_id','content','lat','lng','media','type','name','prices'
    ];
    protected $dates = [
    	'deleted_at',
    ];

    public function getAuthorAttribute(){
    	return User::find($this->user_id);
    }

}
