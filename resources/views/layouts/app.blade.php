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
                    <div class="menu">
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
                                    <a href="{{ route('stream') }}">Le Stream</a>
                                </li>
                                <li>
                                    <a href="#">Membres de CodeShare</a>
                                </li>
                                <li>
                                    <a href="#">Abonnements</a>
                                </li>
                                <li>
                                    <a href="#">Abonnés</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="#">Mon profil</a>
                                </li>
                                <li>
                                    <a href="#">Réglages/Mon compte</a>
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

            <div class="content-container col-md-9">
                @yield('content')
            </div>
        </div>

    </section>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
