@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-md-9 content">
          <div class="add-post-button">
            <button type="button" class="btn form-control" data-toggle="modal" data-target="#ModalPostForm" data-whatever="@mdo"><strong>Ajouter une publication!</strong></button>
          </div>
          <hr>
          <!--Formulaire de publication-->
          <div class="modal fade bd-example-modal-sm" id="ModalPostForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="panel panel-heading text-center">
                <h3 class="panel-heading">Des idées?</h3>
                <form class="formulaire-publication panel-body" method="POST" action="{{route('add.post')}}" enctype="multipart/form-data">
                  <div class="form-group">
                      <input class="form-control" type="text" name="title" placeholder="Le titre de votre publication">
                  </div>
                  <div class="form-group">
                      <textarea class="form-control" name="body" placeholder="Que voulez-vous écrire aujourd'hui?" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="image">Ajouter une image</label>
                    <input class="form-control" type="file" name="image" id="name">
                  </div>

                  <div class="form-group">
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#ModalCodeInput" aria-expanded="false" aria-controls="collapseExample">Ajouter du code</button>
                  </div>

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <!--Code input collapse-->
                  <div class="collapse" id="ModalCodeInput">
                      <textarea class="form-control" name="code" placeholder="Mettez ici votre code" rows="15"></textarea>
                  </div>
                  <hr>
                  <div class="form-group">
                      <button class="btn btn-success">Publier</button>
                  </div>
                </form>
              </div>
            </div>
          </div>


        <!--S'il n'y a rien à afficher-->
        @if(count($posts) == 0)
        <h1>Aucune publication dans votre fil d\'actualité</h1>
        @else

        <!--Les publications-->
        <div class="wrapped">
          @foreach($posts->sortByDesc('created_at') as $post)
              <div class="panel panel-default stream-post-box">
                  <div>
                    <h3>{{$post->title}}</h3>
                    <p class="author-date-publication"><i>publié le {{$post->created_at->format('d/m/Y')}} par <a href="#">{{$post->user->nickname}}</a></i></p>
                  </div>
                  @if($post->postimage_id)
                  <div class="text-center">
                    <img class="img-thumbnail" src="{{$post->postimage->path}}">
                  </div>
                  @endif
                  <div class="panel-body">
                    <p>{{substr($post->body, 0, 250)}}  ...</p>
                  </div>
                  <div class="text-center">
                    <p>{{count($post->like)}} <img src="/resources/assets/img/icons/green-heart.png" width="10px">  |  {{count($post->comment)}} commentaires</p>
                    <a href="{{route('show.post', ['userNickname' => $post->user->nickname, 'postId' => $post->id])}}"><button class="btn btn-primary">Consulter la publication</button></a>
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
