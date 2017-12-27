@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9 content">
          <div class="post-container ">
            <div>
              <div class="text-center">
                <h2>{{$post->title}}</h2>
                <p class="author-date-publication"><i>publié le {{$post->created_at->format('d/m/Y')}} par <a href="#">{{$post->user->nickname}}</a></i></p>
              </div>
              @if($post->postimage_id)
              <div class="text-center">
                <a href="{{$post->postimage->path}}" target="_blank"><img src="{{$post->postimage->path}}" width="600px"></a>
              </div>
              @endif
              <br>
              <div>
                <p>{{$post->body}}</p>
              </div>
              @if($post->code)
              <div>
                <pre class="pre-scrollable">{{$post->code}}</pre>
              </div>
              @endif

              @if(count($likeExist) == 0)
              <p>{{count($post->like)}} <img src="/resources/assets/img/icons/green-heart.png" width="10px">  |  <a href="{{ route('add.like', ['postId' => $post->id]) }}">like</a></p>
              @else
              <p>{{count($post->like)}} <img src="/resources/assets/img/icons/green-heart.png" width="10px">  |  <a href="{{ route('remove.like', ['postId' => $post->id]) }}">unlike</a></p>
              @endif
            </div>
            <hr>

              <!--L'author de la publication peut ici la modifier-->
              <div class="text-center">
                  <button class="btn btn-primary" data-toggle="collapse" href="#editPost{{$post->id}}" aria-expanded="false" aria-controls="editPost{{$post->id}}">Visiter le profil de {{$post->user->nickname}}</button>
                  @if($post->user->id == Auth::user()->id)
                  <button class="btn btn-primary" data-toggle="collapse" href="#editPost{{$post->id}}" aria-expanded="false" aria-controls="editPost{{$post->id}}">Modifier cette publication</button>

                  <!--Toggle pour afficher ou cacher les outils de modification-->
                  <div class="edit-post-div collapse multi-collapse" id="editPost{{$post->id}}">
                    <h4 class="panel-heading">Modifier votre publication: {{$post->title}}</h4>
                    <form class="formulaire-publication panel-body" method="POST" action="{{route('edit.post')}}">
                      <div class="form-group">
                          <input class="form-control" type="text" name="title" value="{{$post->title}}">
                      </div>
                      <div class="form-group">
                          <textarea class="form-control" name="body" placeholder="Que voulez-vous écrire aujourd'hui?" rows="4">{{$post->body}}</textarea>
                      </div>
                      <input type="hidden" name="postId" value="{{$post->id}}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                          <button class="btn btn-success">Appliquer les modifications</button>
                      </div>
                    </form>

                    <!--Bouton et formulaire suppression de la publication-->
                    <a class="btn btn-danger" onclick="
                      event.preventDefault();
                      document.getElementById('delete-post-form').submit();">Supprimer</a>
                      <hr>
                    <form id="delete-post-form" action="{{ route('delete.post') }}" method="POST" style="display: none;">
                      <input type="hidden" name="postId" value="{{$post->id}}">
                        {{ csrf_field() }}
                    </form>
                  </div>

                  @endif
              </div>

              <!--Commentaires-->

              <!--Ajout d'un commentaire-->
              <hr>
              <h3>COMMENTAIRES</h3>
              <form class="text-center" method="POST" action="{{route('add.comment')}}">
                <div class="form-group form-horizontal">
                  <textarea class="form-control" type="text" name="comment" placeholder="Votre commentaire ici"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-success">Ajouter</button>
                </div>
                <input type="hidden" name="postId" value="{{$post->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>

              <!--Afficher les commentaires-->
              @foreach($post->comment->sortByDesc('created_at') as $comment)
              <div class="comment-box">
                <p><strong><a href="#">{{$comment->user->nickname}}</a>:<br> </strong>{{$comment->body}}</p>
                <p class="text-right small"><i>publié le {{$comment->created_at->format('d/m/Y')}}  |  @if($comment->user->id == Auth::user()->id)<a href="#" onclick="event.preventDefault();
                      document.getElementById('delete-comment-form').submit();" >supprimer</a></i></p>@endif

                <!--Formulaire suppression de commentaire-->
                <form id="delete-comment-form" method="POST" action="{{route('delete.comment')}}">
                    <input type="hidden" name="commentId" value="{{$comment->id}}">
                    {{ csrf_field() }}
                </form>
              </div>
              @endforeach
          </div>
        </div>

        <div class="social-side-bar col-md-3">

        </div>


    </div>

</div>
@endsection
