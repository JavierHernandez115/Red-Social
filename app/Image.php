<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    protected $table = 'Images';

    public function Comment() {
    return $this->hasMany('App\Comment', 'Image_Id', 'id')->orderBy('Id','desc');
    }

    public function Like() {
        return $this->hasMany('App\Like', 'Image_Id', 'id');
    }

    public function User() {
        return $this->belongsTo('App\User', 'User_Id');
    }

}
