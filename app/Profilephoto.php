<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profilephoto extends Model
{
    public function profile() {
      return $this->hasOne('App\Profile', 'profilephoto_id', 'id');
    }
}
