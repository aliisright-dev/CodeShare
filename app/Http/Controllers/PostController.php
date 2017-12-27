<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\LikeController;

use App\Post;
use App\Like;
use App\Comment;
use App\Postimage;

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
      $code = $request->input('code');
      $file = Input::file('image');

      if(Auth::check()){
          $newPost = new Post();

          if($title) {
            $newPost->title = $title;
          }

          if($body) {
            $newPost->body = $body;
          }

          if($code) {
            $newPost->code = $code;
          }

          if($file) {
                $extension = $file->getClientOriginalExtension();

                Storage::disk('public')->put(
                  Auth::user()->email.'_'.$file->getFilename().'.'.$extension,
                  File::get($file)
                );

                //Ajout dee la photo dans la table Postimages
                $newPostImage = new Postimage();

                $newPostImage->mime = $file->getClientMimeType();
                $newPostImage->name = Auth::user()->email.'_'.$file->getFilename().'.'.$extension;
                $newPostImage->path = "/storage/app/public/".$newPostImage->name;
                $newPostImage->user_id = Auth::user()->id;

                $newPostImage->save();

                //Assigner le id de la photo (dans Postimage) à la publication (dans Post)
                $newPost->postimage_id = $newPostImage->id;
          }

          if($title OR $body OR $file) {
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
