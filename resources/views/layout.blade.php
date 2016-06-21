<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Places</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(!Auth::check())
                            <li><a href="{{ route('auth.login') }}">Login</a></li>
                            <li><a href="{{ route('auth.register') }}">Register</a></li>
                        @else
                            <li><a href="#">{{ Auth::user()->first_name }}</a></li>
                            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js" type="text/javascript"></script>
        <script src="js/app.js"></script>
    </body>
</html>

