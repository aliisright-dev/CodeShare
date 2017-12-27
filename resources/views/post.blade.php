@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="col-md-9 content">
            <div>
              <div class="text-center">
                <h2>{{$post->title}}</h2>
                <p class="author-date-publication"><i>publié le {{$post->created_at->format('d/m/Y')}} par <a href="#">{{$post->user->nickname}}</a></i></p>
              </div>
              <div>
                <p>{{$post->body}}</p>
              </div>
            </div>
            <hr>

              <!--L'author de la publication peut ici la modifier-->
              <div class="text-center">
                  <button class="btn btn-primary" data-toggle="collapse" href="#editPost{{$post->id}}" aria-expanded="false" aria-controls="editPost{{$post->id}}">Visitez le profil de {{$post->user->nickname}}</button>
                  @if($post->user->id == Auth::user()->id)
                  <button class="btn btn-primary" data-toggle="collapse" href="#editPost{{$post->id}}" aria-expanded="false" aria-controls="editPost{{$post->id}}">Modifiez cette publication</button>

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
                      document.getElementById('delete-post-form').submit();">Supprimer</button></a>
                      <hr>
                    <form id="delete-post-form" action="{{ route('delete.post') }}" method="POST" style="display: none;">
                      <input type="hidden" name="postId" value="{{$post->id}}">
                        {{ csrf_field() }}
                    </form>
                  </div>

                  @endif
              </div>

          </div>

          <div class="social-side-bar col-md-3">

          </div>


    </div>

</div>
@endsection
