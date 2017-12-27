<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class StreamController extends Controller
{
    //Afficher les publications dans le Stream
    public function index() {

      $posts = Post::All();

      return view('stream', ['posts' => $posts]);
    }
}
