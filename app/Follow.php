<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function followed() {
      return $this->belongsTo('App\User', 'followed_id', 'id');
    }

    public function follower() {
      return $this->belongsTo('App\User', 'follower_id', 'id');
    }
}
