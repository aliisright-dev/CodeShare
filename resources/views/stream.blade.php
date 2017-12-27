@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-md-9 content">
        <div class="panel panel-default">
          <!--Formulaire de publication-->
          <h3 class="panel-heading">Dis-nous!</h3>
          <form class="formulaire-publication panel-body" method="POST" action="{{route('add.post')}}">
            <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder="Le titre de votre publication">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="body" placeholder="Que voulez-vous écrire aujourd'hui?" rows="4"></textarea>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <button class="btn btn-success">Publier</button>
            </div>
          </form>
        </div>
        <hr>

        <!--S'il n'y a rien à afficher-->
        @if(count($posts) == 0)
        <h1>Aucune publication dans votre fil d\'actualité</h1>
        @else

        <!--Les publications-->
        <div class="panel panel-default panel-heading">
          @foreach($posts as $post)
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>{{$post->title}}</h3>
                <p class="author-date-publication"><i>publié le {{$post->created_at->format('d/m/Y')}} par <a href="#">{{$post->user->nickname}}</a></i></p>
              </div>
              <div class="panel-body">
                <p>{{substr($post->body, 0, 250)}}  ...</p>
              </div>
              <div class="text-center">
                <p>{{count($post->like)}} likes</p>
                <a href="{{route('show.post', ['userNickname' => $post->user->nickname, 'postId' => $post->id])}}"><button class="btn btn-primary">Consultez la publication</button></a>
                <hr>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      @endif
      <div class="social-side-bar col-md-3">

      </div>


    </div>

</div>
@endsection
