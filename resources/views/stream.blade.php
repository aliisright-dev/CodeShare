@extends('layouts.app')

@section('content')
<div class="">
    <div>

      <div class="content">
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


        <!--Afficher Toutes les cartes ou que les cartes des abonnés-->

          <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link active" href="{{route('stream')}}">Abonnements</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="{{route('streamAll', ['showAll' => 'showAll'])}}">Général</a>
          </nav>

        <!--S'il n'y a rien à afficher-->
        @if(count($posts) == 0)
        <h1>Aucune publication dans votre fil d'actualité</h1>
        @else

        <!--Les publications-->
        <div class="wrapped">
              <a class="div-add-card" data-toggle="modal" href="#ModalPostForm" data-whatever="@mdo"><div class="panel panel-default stream-post-box">
                  <div>
                    <h3>AJOUTER UNE CARTE !</h3>

                    <div class="text-center">
                      <img src="https://openclipart.org/image/2400px/svg_to_png/199051/primary-add.png" width="100px">
                    </div>
                    <br><br>
                  </div>
              </div></a>
          @foreach($posts->sortByDesc('created_at') as $post)
              <div class="panel panel-default stream-post-box">
                  <div>
                    <h3>{{$post->title}}</h3>
                    <p class="author-date-publication"><i>publié le {{$post->created_at->format('d/m/Y')}} par <a href="{{route('show.profile', ['userId' => $post->user->id])}}">{{$post->user->nickname}}</a></i></p>
                  </div>
                  @if($post->postimage_id)
                  <div class="text-center">
                    <img class="img-thumbnail" src="{{$post->postimage->path}}">
                  </div>
                  @endif

                  <div class="panel-body">
                    <p>{{substr($post->body, 0, 250)}}  ...</p>
                  </div>
                  <br>
                  <div class="text-center">
                    <p>{{count($post->like)}} <img src="/resources/assets/img/icons/green-heart.png" width="10px">  |  {{count($post->comment)}} commentaires</p>
                    <a href="{{route('show.post', ['userNickname' => $post->user->nickname, 'postId' => $post->id])}}"><button class="btn btn-primary">Consulter cette carte</button></a>
                    <hr>
                  </div>
              </div>
          @endforeach
        </div>
      </div>
      @endif



    </div>

</div>
@endsection
