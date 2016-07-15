<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Todo List')</title>

    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet" type="text/css">

    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/js/bootstrap.min.js')}}"></script>

    <script src="{{url('/js/bootstrap-datepicker.min.js')}}" ></script>
    <script src="{{url('/js/locales/bootstrap-datepicker.de.min.js')}}" ></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid  title">

            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="">profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>



        </div>
    </nav>

<div class="container">


    @yield('content')

</div>
</body>
</html>
