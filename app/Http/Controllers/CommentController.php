<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;

class CommentController extends Controller
{
    //Ajout d'un nouveau commentaire
    public function addComment(Request $request) {

      $comment = $request->input('comment');
      $postId = $request->input('postId');

      if(Auth::check()){
          if($comment && $postId) {
            $newComment = new Comment();

            $newComment->body = $comment;
            $newComment->post_id = $postId;
            $newComment->user_id = Auth::user()->id;

            $newComment->save();
          }
      }

      return redirect()->back();
    }

    //supprimer un commentaire
    public function deleteComment(Request $request) {

      $commentId = $request->input('commentId');

      if(Auth::check()){
          if($commentId) {
            $deleteComment = Comment::where('id', $commentId)->first();

            if($deleteComment->user_id == Auth::user()->id) {
              $deleteComment->delete();
            }
          }
      }

      return redirect()->back();
    }

}
