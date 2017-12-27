<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Like;

class LikeController extends Controller
{
    //Ajouter un like
    public function addLike($postId) {

      $likeExist = Like::where('user_id', Auth::user()->id)->where('post_id', $postId)->get();

      if(count($likeExist) == 0 ) {
        $newLike = new Like();

        $newLike->user_id = Auth::user()->id;
        $newLike->post_id = $postId;

        $newLike->save();
      }

      return redirect()->back();
    }

    //retirer un like
    public function removeLike($postId) {

      $likeExist = Like::where('user_id', Auth::user()->id)->where('post_id', $postId);

      if(count($likeExist) > 0) {
        $likeExist->delete();
      }
      return redirect()->back();
    }
}
