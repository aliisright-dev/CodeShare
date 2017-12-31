<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Follow;

class StreamController extends Controller
{
    //Afficher les publications dans le Stream
    public function index() {

      $followedUsersIds = Follow::select('followed_id')->where('follower_id', Auth::user()->id);

      $posts = Post::wherein('user_id', $followedUsersIds)->orwhere('user_id', Auth::user()->id)->get();

      return view('stream', ['posts' => $posts]);
    }

    public function showAll($showAll) {

      if(isset($showAll)){

        $posts = Post::All();

      }
      return view('stream', ['posts' => $posts]);
    }
}
