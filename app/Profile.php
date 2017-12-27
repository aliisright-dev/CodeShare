<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user() {
      return $this->hasOne('App\User', 'profile_id', 'id');
    }

    public function profilephoto() {
      return $this->belongsTo('App\Profilephoto', 'profilephoto_id', 'id');
    }
}
