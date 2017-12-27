<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LikeController;

use App\Post;
use App\Like;
use App\Comment;

class PostController extends Controller
{
    //Afficher la page Post (une publication individuelle)
    public function index($userNickname, $postId) {

      $post = Post::where('id', $postId)->first();

      $likeExist = Like::where('user_id', Auth::user()->id)->where('post_id', $postId)->get();

      return view('post', ['post' => $post, 'likeExist' => $likeExist]);
    }

    //Ajout d'une nouvelle publication
    public function addPost(Request $request) {

      $title = $request->input('title');
      $body = $request->input('body');

      if(Auth::check()){
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
      }
      return redirect()->back();
    }

    //Modification de publication
    public function editPost(Request $request) {

      $title = $request->input('title');
      $body = $request->input('body');
      $postId = $request->input('postId');

      if(Auth::check()){
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
      }
      return redirect()->back();
    }

    //supprimer une publication
    public function deletePost(Request $request) {

      $postId = $request->input('postId');

      if(Auth::check()){
          if($postId) {
            $deletePost = Post::where('id', $postId)->first();
            $deletePostComments = Comment::where('post_id', $postId);
            $deletePostLikes = Like::where('post_id', $postId);

            if($deletePost->user_id == Auth::user()->id) {
              $deletePost->delete();
              $deletePostComments->delete();
              $deletePostLikes->delete();
            }
          }
      }

      return redirect('/stream');
    }
}
