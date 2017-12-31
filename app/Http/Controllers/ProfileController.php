<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Follow;

class ProfileController extends Controller
{
    public function index($userId) {

      $profile = User::where('id', $userId)->first();

      //Vérifier si je suis déjà abonnée à cet utilisateur
      $followExist = Follow::where('followed_id', $userId)->where('follower_id', Auth::user()->id)->get();

      return view('profile', ['profile' => $profile, 'followExist' => $followExist]);
    }
}
