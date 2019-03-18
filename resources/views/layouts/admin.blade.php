<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Elisanda</title>

    <link href="https://fonts.googleapis.com/css?family=Lora:400i,700i|Montserrat&amp;subset=cyrillic-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/css/style.css">
    @yield('scripts_top')

</head>
<body>
<div id="head">



        <div id="admin_nav">
            <nav>
                <ul class="flex paddingH1">
                    <li class="active"><a href="{{url('/')}}">sakums</a></li>
                    <li class=""><a href="{{url('/programms')}}">programmas</a></li>
                    <li class=""><a href="{{url('/galleries')}}">galerijas</a></li>
                </ul>
            </nav>
        </div>

</div>
@yield('content')
</body>
@yield('scripts_bottom')
</html>