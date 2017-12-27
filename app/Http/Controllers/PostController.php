<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;

class PostController extends Controller
{
    //Afficher la page Post (une publication individuelle)
    public function index($userNickname, $postId) {

      $post = Post::where('id', $postId)->first();

      return view('post', ['post' => $post]);
    }

    //Ajout d'une nouvelle publication
    public function addPost(Request $request) {

      $title = $request->input('title');
      $body = $request->input('body');

      $newPost = new Post();

      if($title) {
        $newPost->title = $title;
      }

      if($body) {
        $newPost->body = $body;
      }

      if($title OR $body) {
        $newPost->user_id = Auth::user()->id;
        $newPost->save();
      }

      return redirect()->back();
    }

    //Modification de publication
    public function editPost(Request $request) {

      $title = $request->input('title');
      $body = $request->input('body');
      $postId = $request->input('postId');


      if($postId) {
        $newPost = Post::where('id', $postId)->first();

        if($newPost->user_id == Auth::user()->id) {
          if($title) {
            $newPost->title = $title;
          }
          if($body) {
            $newPost->body = $body;
          }
          if($title OR $body) {
            $newPost->save();
          }
        }
      }

      return redirect()->back();
    }

    //supprimer une publication
    public function deletePost(Request $request) {

      $postId = $request->input('postId');

      if($postId) {
        $deletePost = Post::where('id', $postId)->first();

        if($deletePost->user_id == Auth::user()->id) {
          $deletePost->delete();
        }
      }

      return redirect()->back();
    }
}
