@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="content container">
            <!--Information générales-->
          <div class="member-card">
            <div class="row">
              <div class="col-md-4 profile-photo-nickname">
                <div class="profile-user-photo"></div>
                <h3>{{$profile->nickname}}</h3>
              </div>
              <div class="col-md-4 text-center">
                <p>Ali Hasan</p>
                <p>26 ans</p>
                <p>France</p>
              </div>
              <div class="col-md-4 text-center">
                <p>Adipisicing enim dolor fugiat dolor id irure labore culpa esse amet.</p>
              </div>
            </div>
          </div>

          <!--les publication de cet utilisateur-->
          <div class="">
            <div class="row">
              <div class="user-posts col-md-6">
                @if(count($profile->post) == 0)
                <h3 class="message-posts-exist text-center">{{$profile->nickname}} n'a pas encore ajouté des cartes</h3>
                @else
                <h3 class="message-posts-exist text-center">Les cartes de {{$profile->nickname}}</h3>
                @foreach($profile->post->sortByDesc('created_at') as $post)
                  <div class="profile-post-div">
                    <h4>{{$post->title}}</h4>
                    <p class="author-date-publication"><i>publié le {{$post->created_at->format('d/m/Y')}}</i></p>
                    <p>{{substr($post->body, 0, 250)}} ... <a href="{{route('show.post', ['userNickname' => $post->user->nickname, 'postId' => $post->id])}}"><i>consulter cette carte</i></a></p>
                  </div>
                @endforeach
                @endif
              </div>
              <!--les outils utilisateur-->


              <div class="user-tools col-md-6">

                <div class="list-group">
                  @if($profile->id != Auth::user()->id)
                    @if(count($followExist) == 0)
                      <a href="{{route('follow.user', ['followedId' => $profile->id])}}" class="list-group-item list-group-item-text"><img src="/resources/assets/img/icons/follow-icon.png" width="20px"> Suivre {{$profile->nickname}}</a>
                    @else
                      <a href="{{route('unfollow.user', ['followedId' => $profile->id])}}" class="list-group-item list-group-item-text"><img src="/resources/assets/img/icons/unfollow-icon.png" width="20px"> Ne plus suivre {{$profile->nickname}}</a>
                    @endif

                    <a href="#" class="list-group-item list-group-item-text disabled"><img src="/resources/assets/img/icons/message-icon.png" width="20px"> Envoyer un message à {{$profile->nickname}}</a>
                  @elseif($profile->id == Auth::user()->id)
                    <a href="#" class="list-group-item list-group-item-text"><img src="/resources/assets/img/icons/settings-icon.png" width="20px"> Modifier mon profil</a>
                  @endif
                  <a href="#" class="list-group-item list-group-item-text"><img src="/resources/assets/img/icons/followers-icon.png" width="20px"> Abonnées</a>
                  <a href="#" class="list-group-item list-group-item-text"><img src="/resources/assets/img/icons/following-icon.png" width="20px"> Abonnements</a>
                  <a href="#" class="list-group-item list-group-item-text disabled"><img src="/resources/assets/img/icons/github-icon.png" width="20px"> Le profile GitHub de {{$profile->nickname}}</a>
                  <a href="#" class="list-group-item list-group-item-text disabled"><img src="/resources/assets/img/icons/linkedin-icon.png" width="20px"> Le profile Linkedin de {{$profile->nickname}}</a>
                </div>
              </div>
            </div>
          </div>

        </div>


    </div>

</div>
@endsection
