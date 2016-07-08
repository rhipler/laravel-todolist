<!DOCTYPE html>
<html>
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
<div class="container-fluid  title">
    <h1>TODO Manager</h1>
</div>

<div class="container">
    <div class="page-header">
        <h2>@yield('pagetitle')</h2>
    </div>

    @yield('content')

</div>
</body>
</html>
