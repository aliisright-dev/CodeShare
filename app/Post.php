<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
      return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function postimage() {
      return $this->belongsTo('App\Postimage', 'postimage_id', 'id');
    }

    public function like() {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }
}
