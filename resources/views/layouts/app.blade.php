<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--Mes Feuilles de style-->
    <!--layout.css--><link rel="stylesheet" type="text/css" href="/resources/assets/css/layout.css">
    <!--stream.css--><link rel="stylesheet" type="text/css" href="/resources/assets/css/stream.css">
    <!--post.css--><link rel="stylesheet" type="text/css" href="/resources/assets/css/post.css">
    <!--profile.css--><link rel="stylesheet" type="text/css" href="/resources/assets/css/profile.css">
</head>
<body>

    <section class="container-fluid">

        <div class="row">
            <div class="navigation col-md-3">
                <header>
                    <!--Logo-->
                    <div class="logo">
                        <h1>CodeShare</h1>
                    </div>
                    <!--Menu de navigation-->

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="toggle"></span>
                        <img src="/resources/assets/img/icons/green-burger-menu.png" width="40px">
                    </button>

                    <div class="menu collapse navbar-collapse" id="app-navbar-collapse">
                        @auth
                        <h4 class="nickname-greating">Yello {{Auth::user()->nickname}} !</h4>
                        @endauth
                        <hr>
                        <ul class="list-unstyled">
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <li>
                                    <a href="{{ route('stream') }}"><img src="/resources/assets/img/icons/stream-icon.png" width="20px"> Le Stream</a>
                                </li>
                                <li>
                                    <a class="align-baseline" href="#"><img src="/resources/assets/img/icons/members-icon.png" width="20px"> Membres de CodeShare</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/resources/assets/img/icons/following-icon.png" width="20px"> Mes abonnements</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/resources/assets/img/icons/followers-icon.png" width="20px"> Mes abonnés</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="{{route('show.profile', ['userId' => Auth::user()->id])}}"><img src="/resources/assets/img/icons/profile-icon.png" width="20px"> Mon profil</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/resources/assets/img/icons/settings-icon.png" width="20px"> Réglages/Mon compte</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </header>

                <!--Footer (copyright)-->
                <footer><p>&copy Ali Hasan 2017</p></footer>

            </div>

            <div class="col-md-9">
                @yield('content')
            </div>
        </div>

    </section>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
