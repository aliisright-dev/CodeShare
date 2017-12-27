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
        'nickname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile() {
        return $this->belongsTo('App\Profile', 'profile_id', 'id');
    }

    public function followed() {
        return $this->hasMany('App\Follow', 'followed_id', 'id');
    }

    public function follower() {
        return $this->hasMany('App\Follow', 'follower_id', 'id');
    }

    public function post() {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function like() {
        return $this->hasMany('App\Like', 'user_id', 'id');
    }

    public function comment() {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }
}
