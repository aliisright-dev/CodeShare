<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Follow;
use App\Followlog;

class FollowController extends Controller
{
    //S'abonner à un utilisateur
    public function follow($followedId) {

      if(Auth::check()) {

        //Vérifier si l'abonnement existe déjà
        $followExist = Follow::where('followed_id', $followedId)->where('follower_id', Auth::user()->id)->get();

        //L'abonnement n'existe pas ET l'utilisateur ne va pas suivre lui même
        if(count($followExist) == 0 && $followedId != Auth::user()->id) {
          $newFollow = new Follow();

          $newFollow->followed_id = $followedId;
          $newFollow->follower_id = Auth::user()->id;

          $newFollow->save();

          //Enregistrer le follow dans la table followlog
          $newFollowlog = new Followlog();

          $newFollowlog->followed_id = $followedId;
          $newFollowlog->follower_id = Auth::user()->id;

          $newFollowlog->save();
        }
      }

      return redirect()->back();
    }

    //ne plus suivre un utilisateur
    public function unfollow($followedId) {

      if(Auth::check()) {

        //Vérifier si l'abonnement existe déjà
        $followExist = Follow::where('followed_id', $followedId)->where('follower_id', Auth::user()->id)->first();

        //L'abonnement existe déjà ET l'utilisateur ne va pas unfollow lui même
        if(count($followExist) > 0 && $followedId != Auth::user()->id) {

          $followExist->delete();

        }
      }

      return redirect()->back();
    }

}
