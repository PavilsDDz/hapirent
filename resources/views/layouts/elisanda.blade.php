<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta')

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>Elisanda</title>

        <link href="https://fonts.googleapis.com/css?family=Lora:400i,700i|Montserrat&amp;subset=cyrillic-ext" rel="stylesheet">
        <link rel="stylesheet" href="{{url('/')}}/css/style.css">
        <!-- <script type="text/javascript" src="{{url('/')}}/js/jquery.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/js/hammer.js"></script>
        <script type="text/javascript">
            let in_page = 0;
            let ww = window.innerWidth

            window.addEventListener('resize',function(){
                ww = window.innerWidth
            })

        </script>
        <script type="text/javascript">
            let scroll_functions = [];
        let ticking = false;

         window.addEventListener('scroll', function(e) {

          last_known_scroll_position = window.scrollY;

          if (!ticking) {

            window.requestAnimationFrame(function() {
            for (var i = 0; i < scroll_functions.length; i++) {
                scroll_functions[i](last_known_scroll_position)
            }
                //console.log(scroll_functions)
            //  window_scrolling(last_known_scroll_position);
              ticking = false;
            });
             
            ticking = true;

          }
          
        });
        </script>
        @yield('scripts_top')

    </head>
    <body>
        <div id="main_bg_img">
            <div id="main_bg_color">
                
            </div>
        </div>
        <div id="head">
            <div class="flex paddingH1">
                
                <form action="{{url('/')}}/language" method="post" class="" id="language">
                    <div class="lang_wrap ">
                                            
                        <div>
                                                
                            @if(Lang::locale()=='lv')
                                             
                                <button type="submit" name="locale" id="lang_en" value="ru">ru</button>
                                                    
                            @else 
                                               
                                <button type="submit" name="locale" id="lang_en" value="lv">lv</button>

                            @endif

                            </div>
                        </div>
                                       
                    {{csrf_field()}}
                </form>
                <div id="nav_toggle" class="flex sb column">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            
            @auth
                <div id="admin_nav">
                    <nav>
                        <ul class="flex paddingH1">
                            <li id="main_nav_home_admin" class=""><a href="{{url('/')}}">{{trans('lang.home')}}</a></li>
                            <li id="main_nav_programs_admin" class=""><a href="{{url('/')}}/programms/admin">{{trans('lang.programs')}}</a></li>
                            <li id="main_nav_holistikMethods_admin" id=""><a href="{{url('/holistikMethods/admin')}}">{{trans('lang.holistik_methods')}}</a></li>
                            <li id="main_nav_seminars_admin" id="main_nav_seminars"><a href="{{url('/seminars/admin')}}">{{trans('lang.seminars')}}</a></li>
                            <li id="main_nav_articles_admin" id="main_nav_articles" class=""><a href="{{url('/articles/admin')}}">{{trans('lang.news')}}</a></li>
                            <li id="main_nav_galleries_admin" class=""><a href="{{url('/galleries/admin')}}">{{trans('lang.gallery')}}</a></li>
                            <li id="logout_link"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </ul>
                    </nav>
                </div>
            @endauth
            <div id="nav_wrap" class="">

                <nav id="main_nav">
                    <ul class="flex mob_col paddingH1" >
                        <li id="main_nav_home" class=""><a href="{{url('/')}}">{{trans('lang.home')}}</a></li>
                        <li id="main_nav_programs" class=""><a href="{{url('/programms')}}">{{trans('lang.programs')}}</a></li>
                        <li id="main_nav_holistikMethods" ><a href="{{url('/holistikMethods')}}">{{trans('lang.holistik_methods')}}</a></li>
                        <li id="main_nav_seminars" ><a href="{{url('/seminars')}}">{{trans('lang.seminars')}}</a></li>
                        <li id="main_nav_articles" class=""><a href="{{url('/articles')}}">{{trans('lang.news')}}</a></li>
                        <li id="main_nav_galleries" class=""><a href="{{url('/galleries')}}">{{trans('lang.gallery')}}</a></li>
                        <li id="main_nav_about" class=""><a href="{{url('/aboutus')}}">{{trans('lang.about_us')}}</a></li>
                        <li id="main_nav_contacts" class=""><a href="{{url('/contacts')}}">{{trans('lang.contacts')}}</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        @yield('content')
        <div class="footer paddingH1">
            <div class="flex mob_col"> 
                <div class="footer_logo flex">
                    <img src="{{url('/')}}/img/logo_w.svg" class="logo">
                </div>
                <div id="footer_nav">
                    <nav>
                        <ul class="flex mob_col">
                            
                            
                            


                            <li id="footer_nav_home" class=""><a href="{{url('/')}}">{{trans('lang.home')}}</a></li>
                            <li id="footer_nav_programs" class=""><a href="{{url('/programms')}}">{{trans('lang.programs')}}</a></li>
                            <li id="footer_nav_holistikMethods" ><a href="{{url('/holistikMethods')}}">{{trans('lang.holistik_methods')}}</a></li>
                            <li id="footer_nav_seminars" ><a href="{{url('/seminars')}}">{{trans('lang.seminars')}}</a></li>
                            <li id="footer_nav_articles" class=""><a href="{{url('/articles')}}">{{trans('lang.news')}}</a></li>
                            <li id="footer_nav_galleries" class=""><a href="{{url('/galleries')}}">{{trans('lang.gallery')}}</a></li>
                            <li id="footer_nav_about" class=""><a href="{{url('/aboutus')}}">{{trans('lang.about_us')}}</a></li>
                            <li id="footer_nav_contacts" class=""><a href="{{url('/contacts')}}">{{trans('lang.contacts')}}</a></li>



                        </ul>
                    </nav>
                </div>
            </div>
            <div >
                <div class="flex copy mob_col"><p>© “ELISANDA” 2018</p> <a target="blank" href="http://testportfolio.tk" id="pddz">Pāvils Dailis Dzirkalis</a></div>

            </div>
        </div>
    </body>
    @yield('scripts_bottom')
    <script type="text/javascript">
        if (in_page) {
            document.getElementById('main_nav_'+in_page).classList.add('active')

        }else{
            document.getElementById('main_nav_home').classList.add('active')
        }
    </script>
    <script type="text/javascript">
        let main_bg_div = document.getElementById('main_bg_img')

        scroll_functions.push(function(scroll){
            // main_bg_div.style.backgroundPositionY = -scroll/10 + 'px'
        })
    </script>
    <script type="text/javascript">
        $(function(){
            $('#nav_toggle').click(function(){
                $('#main_nav ul').slideToggle()
            })
        })
    </script>

</html>