<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $table = 'Likes';

    public function User() {
        return $this->belongsTo('App\User', 'User_Id');
    }

    public function Image() {
        return $this->belongsTo('App\Image', 'Image_Id');
    }

}
