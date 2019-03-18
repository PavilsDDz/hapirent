<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
   
    <script type="text/javascript">
        var base_url = '{{url("/")}}'
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{url('/js/common.js')}}"></script>  
    <script type="text/javascript" src="{{url('/js/popup.js')}}"></script>
  
    <!-- scripts frmo pages   -->
    
    @stack('scripts_top')

    @yield('scripts_top')

    <!-- Fonts -->



    <!-- Styles -->
     <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,400i,600,800,800i" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav id="topnav">
            <div class="flex">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <div id="main_logo">
                        <img src="{{ url('/')}}/img/logo.svg">
                    </div>
                </a>
                

                <div class="flex" id="header_content">
                
                    <ul class="navbar-nav flex">
                        <li>    
                        <a href="/posts">Rent this stuff</a>
                        </li>
                        <li>   
                        <a href="/posts/create">Add for rent</a>
                        </li>
                        <li>    
                        <!-- Authentication Links -->
                        <div class="user_links">
                            <ul class="flex">    
                                        
                            @guest
                                <li>
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li>    
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @else
                               

                                <li>
                                    <a class="nav-link " href="{{url('/')}}/profile" v-pre>{{trans('global.profile')}}</a>
                                </li>
                                <li>    
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </li>
                                <li>    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                   
                            </ul>
                        </div>
                        </li>
                        <li>   
                                <form method="post" action="language">
                                    {{csrf_field()}}
                                    <div class="lang_wrap">
                                        
                                        <div>
                                            
                                            @if(Lang::locale()=='lv')
                                         
                                                <button type="submit" name="locale" id="lang_en" value="en">en</button>
                                                
                                            @else 
                                           
                                                <button type="submit" name="locale" id="lang_en" value="lv">lv</button>

                                            @endif

                                        </div>
                                    </div>
                                   

                                </form>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div id="popup"></div>
        <div class="content">
            <div id="sub_nav">@yield('subnav')</div>
            @yield('content')
        </div>
    </div>
            <div id="footer">
                <div class="container">
                    <!-- <div id="footer_logo">
                        <img src="{{ url('/')}}/img/logo.svg">
                    </div> -->
                    
                        <nav id="footer_nav" class="flex sb paddingV1">
                            <ul class="footer_link_group flex">
                                <li>{{trans('index.contact_us')}}</li>
                                <li>{{trans('index.rules')}}</li>
                                <li>{{trans('index.about')}}</li>
                            </ul>
                            <ul class="footer_link_group flex">
                                <li>{{trans('index.search')}}</li>
                                <li>{{trans('index.add')}}</li>
                            </ul>
                             <ul class="footer_link_group flex">
                                <li>{{trans('index.profile')}}</li>
                            </ul>
                        </nav>
                    <ul class="flex social_link cc" id="footer_socail_links">
                        <li class="facebook_link"><a href=""></a></li>
                        <li class="instagram_link"><a href=""></a></li>
                        <li class="twitter_link"><a href=""></a></li>
                    </ul>
                    <p class="tc"><small> All rights reserved  © Hapirent 2018 </small> </p>
                </div>
            </div>
     @yield('scripts_bottom')
    @stack('scripts_bottom')
    
     
</body>


</html>
