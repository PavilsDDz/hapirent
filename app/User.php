<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','regNumber','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setTypeAttribute($value){
        $type ='';
        if ($value=='pri') {
            $type = 0;
        }else if ($value=='jur') {
            $type = 1;
        }else{
            $type =0;
        }

        $this->attributes['type'] = $type;
    }

    public function  getImageAttribute($value){
        if($value==null){
            return url('/').'/img/avatar.jpg';
        }else{
            return $value;
        }

    }
}
