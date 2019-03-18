@extends('layouts.elisanda')
<?php   
    
        if ($gal!=null) {
            $gallery = get_object_vars ( $gal );
        }else {
            $gallery =false;
        }
        $program = get_object_vars ( $prgm );
        $lng = Lang::locale();
     ?>
@section('scripts_top')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/froala_editor.css">
    <link rel="stylesheet" href="/css/froala_style.css">
    <link rel="stylesheet" href="/css/text_plugins/code_view.css">
    <link rel="stylesheet" href="/css/text_plugins/draggable.css">
    <link rel="stylesheet" href="/css/text_plugins/colors.css">
    <link rel="stylesheet" href="/css/text_plugins/emoticons.css">
    <link rel="stylesheet" href="/css/text_plugins/image_manager.css">
    <link rel="stylesheet" href="/css/text_plugins/image.css">
    <link rel="stylesheet" href="/css/text_plugins/line_breaker.css">
    <link rel="stylesheet" href="/css/text_plugins/table.css">
    <link rel="stylesheet" href="/css/text_plugins/char_counter.css">
    <link rel="stylesheet" href="/css/text_plugins/video.css">
    <link rel="stylesheet" href="/css/text_plugins/fullscreen.css">
    <link rel="stylesheet" href="/css/text_plugins/file.css">
    <link rel="stylesheet" href="/css/text_plugins/quick_insert.css">
    <link rel="stylesheet" href="/css/text_plugins/help.css">
    <link rel="stylesheet" href="/css/third_party/spell_checker.css">
    <link rel="stylesheet" href="/css/text_plugins/special_characters.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
    <script type="text/javascript">
        function show_lang(that,lng){
            let controls = that.parentNode
            let wrap = controls.parentNode
            let el = wrap.getElementsByClassName(lng)[0]
            let cont = wrap.getElementsByClassName('lang_container')
            let btns = controls.getElementsByTagName('a')
            for (var i = 0; i < btns.length; i++) {
                btns[i].classList.remove('active')
            }
            for (var i = 0; i < cont.length; i++) {
                cont[i].style.display = 'none'
            }
            el.style.display = 'block'
            that.classList.add('active')
        }
    </script>
    
    <script type="text/javascript">
            in_page = 'seminars';
    </script>


@endsection
@section('content')


    <form method="post" action="{{url('/')}}/seminars">
        @csrf
        
        {{ method_field('delete') }}
        <button type="submit" value="{{$program['id']}}" name="id">delete</button>
    </form>
    <form action="{{url('seminars/create')}}" method="POST">
        @csrf
        @method('put')
        <div class="form_content">
            <div class="">
                <h2>{{trans('lang.title')}}</h2>
            </div>


                <div class="flex sb paddingH1">
                  <div class="input flex column column2">
                   <label for="gallery_title_lv">{{trans('lang.title')}} lv:</label><input type="text" value="{{$program['title_lv']}}" name="title_lv" >
                  </div>
                  <div class="input flex column column2">
                   <label for="gallery_title_ru">{{trans('lang.title')}} ru:</label> <input type="text" value="{{$program['title_ru']}}" name="title_ru">
                  </div>
                </div>

                <div class="input flex paddingH1 datetime_input">
                <label for="datepicker">{{trans('lang.date')}}</label>
                <input type="date" name="date" value="{{date('Y-m-d',$program['happening_at'])}}" id="datepicker">
                <label for="datepicker">{{trans('lang.time')}}</label>
                <select name="hour">
                    <option value="01" @if(date('H',$program['happening_at'])=='01')
                    selected
                    @endif 
                    >01</option>
                    <option value="02" @if(date('H',$program['happening_at'])=='02')
                    selected
                    @endif 
                    >02</option>
                    <option value="03" @if(date('H',$program['happening_at'])=='03')
                    selected
                    @endif 
                    >03</option>
                    <option value="04" @if(date('H',$program['happening_at'])=='04')
                    selected
                    @endif 
                    >04</option>
                    <option value="05" @if(date('H',$program['happening_at'])=='05')
                    selected
                    @endif 
                    >05</option>
                    <option value="06" @if(date('H',$program['happening_at'])=='06')
                    selected
                    @endif 
                    >06</option>
                    <option value="07" @if(date('H',$program['happening_at'])=='07')
                    selected
                    @endif 
                    >07</option>
                    <option value="08" @if(date('H',$program['happening_at'])=='08')
                    selected
                    @endif 
                    >08</option>
                    <option value="09" @if(date('H',$program['happening_at'])=='09')
                    selected
                    @endif 
                    >09</option>
                    <option value="10" @if(date('H',$program['happening_at'])=='10')
                    selected
                    @endif 
                    >10</option>
                    <option value="11" @if(date('H',$program['happening_at'])=='11')
                    selected
                    @endif 
                    >11</option>
                    <option value="12" @if(date('H',$program['happening_at'])=='12')
                    selected
                    @endif 
                    >12</option>
                    <option value="13" @if(date('H',$program['happening_at'])=='13')
                    selected
                    @endif 
                    >13</option>
                    <option value="14" @if(date('H',$program['happening_at'])=='14')
                    selected
                    @endif 
                    >14</option>
                    <option value="15" @if(date('H',$program['happening_at'])=='15')
                    selected
                    @endif 
                    >15</option>
                    <option value="16" @if(date('H',$program['happening_at'])=='16')
                    selected
                    @endif 
                    >16</option>
                    <option value="17" @if(date('H',$program['happening_at'])=='17')
                    selected
                    @endif 
                    >17</option>
                    <option value="18" @if(date('H',$program['happening_at'])=='18')
                    selected
                    @endif 
                    >18</option>
                    <option value="19" @if(date('H',$program['happening_at'])=='19')
                    selected
                    @endif 
                    >19</option>
                    <option value="20" @if(date('H',$program['happening_at'])=='20')
                    selected
                    @endif 
                    >20</option>
                    <option value="21" @if(date('H',$program['happening_at'])=='21')
                    selected
                    @endif 
                    >21</option>
                    <option value="22" @if(date('H',$program['happening_at'])=='22')
                    selected
                    @endif 
                    >22</option>
                    <option value="23" @if(date('H',$program['happening_at'])=='23')
                    selected
                    @endif 
                    >23</option>
                    <option value="00" @if(date('H',$program['happening_at'])=='00')
                    selected
                    @endif 
                    >00</option>
                </select>
                <span>:</span>
                <select name="minutes">
                    <option value="00" @if(date('i',$program['happening_at'])=='00')
                    selected
                    @endif 
                     >00</option>
                    <option value="10" @if(date('i',$program['happening_at'])=='10')
                    selected
                    @endif 
                     >10</option>
                    <option value="20" @if(date('i',$program['happening_at'])=='20')
                    selected
                    @endif 
                     >20</option>
                    <option value="30" @if(date('i',$program['happening_at'])=='30')
                    selected
                    @endif 
                     >30</option>
                    <option value="40" @if(date('i',$program['happening_at'])=='40')
                    selected
                    @endif 
                     >40</option>
                    <option value="50" @if(date('i',$program['happening_at'])=='50')
                    selected
                    @endif 
                     >50</option>
                </select>
            </div>



                <!-- <input type="text" value="{{$program['title_lv']}}" name="title_lv" > -->
                <input type="hidden" value="{!!$program['description_lv']!!}" name="description_lv" id="description_lv">
                <!-- <input type="text" value="{{$program['title_ru']}}" name="title_ru"> -->
                <input type="hidden" value="{!!$program['description_ru']!!}" name="description_ru" id="description_ru">

            <div class="">
                <h2>{{trans('lang.description')}}</h2>
            </div>
                <div id="lang_switch" lang_wrap="">
                    <div class="controls">
                        <button type="button" id="lang_lv" class="button1 active">latviski</button>
                        <button type="button" id="lang_ru" class="button1">krieviski</button>
                    </div>
                </div>
            <div id="editor" class="paddingH1">
                <div id='edit' style="margin-top: 30px;">
                </div>
            </div>

            <div class="">
                <h2>{{trans('lang.gallery')}}</h2>
            </div>
            @if(empty($gal))
            <div id="add_galery">
                <span>izveidot galeriju</span>
                <img src="{{url('/')}}/img/icons/no-img.jpg" id="selected_gallery_img" alt="">
                <input type="hidden" id="gallery_form_input" name="gallery" value="">
            </div>
            @else
            <div class="gallery_container paddingH1 flex sb">
                <input type="hidden" id="gallery_form_input" name="gallery" value="{{$gal->id}}">

                <div class="column2">
                        @include('galleries.gallery_include')
                </div>
                <div class="column2">
                    <div class="lang_wrap">
                        <div class="controls">
                            <a class="button1 active" onclick="show_lang(this,'lv')">lv</a>
                            <a class="button1" onclick="show_lang(this,'ru')">ru</a>
                        </div>
                        <div class="lang_container lv" >
                            <h3>{{$gallery['title_'.$lng]}}</h3>
                            <p>{{$gallery['description_'.$lng]}}</p>
                        </div>
                        <div class="lang_container ru" style="display: none">
                            <h3>{{$gallery['title_ru']}}</h3>
                            <p>{{$gallery['description_ru']}}</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            <button type="button" id="edit_gallery">Edit Gallery</button>
        @endif
        </div>
        <div>
            @include('galleries.gallery_input')
        </div>

        <div>
            <button type="submit" class="apply2">{{trans('edit.save')}}</button>
        </div>

    </form>
   
    <div id="debuger">   </div>
@endsection
@section('scripts_bottom')
    <style>
    body {
        text-align: center;
    }

    .ss {
        background-color: red;
    }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

    <script type="text/javascript" src="/js/froala_editor.min.js" ></script>
    <script type="text/javascript" src="/js/text_plugins/align.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/code_view.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/colors.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/draggable.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/entities.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/file.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/font_size.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/font_family.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/image.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/link.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/lists.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/quote.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/table.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/save.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/url.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/video.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/help.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/print.min.js"></script>
    <script type="text/javascript" src="/js/third_party/spell_checker.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/special_characters.min.js"></script>
    <script type="text/javascript" src="/js/text_plugins/word_paste.min.js"></script>

    <script>
        $(function(){
            $('#edit').froalaEditor()
            $('#edit').froalaEditor('html.set','{!!$program["description_lv"]!!}')
        });
    </script>

   
    <script>
        //LANGUAGE SWITCH
        let lang = 'lv';
        let myElement = document.getElementById('edit');

        $('#edit').on('froalaEditor.keypress', function (e, editor, keypressEvent) {
            contentChanged();
        });
        // if(window.addEventListener) {
        //     // Normal browsers
        //     myElement.addEventListener('DOMSubtreeModified', contentChanged, false);
        // } else
        // if(window.attachEvent) {
        //     // IE
        //     myElement.attachEvent('DOMSubtreeModified', contentChanged);
        // }

        function contentChanged() {
           // console.log(document.getElementById('edit').innerHTML)
            html = $('#edit').froalaEditor('html.get');
            //console.log(html)
            document.getElementById('description_'+lang).value = html;
            console.log(document.getElementById('description_'+lang).value)
        }
        function swithc_lang(l){
            lang = l;
             previos = document.getElementById('description_'+l).value
            console.log(previos+' <-previos')
             if (previos!=null&&previos!=''){
                 $('#edit').froalaEditor('html.set', previos);
             }else{
                 $('#edit').froalaEditor('html.set', '<p></p>');
             }
            //$('#edit').editable('setHTML', '', true)
        }
        function switch_active (that){
            let cont = that.parentNode
            for (var i = 0; i < cont.childNodes.length; i++) {
                if (cont.childNodes[i].classList) {
                    cont.childNodes[i].classList.remove('active')
                }
            }
            that.classList.add('active')
        }
        document.getElementById('lang_lv').addEventListener('click',function () {

            swithc_lang('lv')
            switch_active(this)

        })
        document.getElementById('lang_ru').addEventListener('click',function () {

            swithc_lang('ru')
            switch_active(this)
        })

    </script>
    <script>
        //GALLERIES script
        $(function(){
            $('#edit_gallery').click(function(){
                $('#gallery_input').slideToggle(300)
            })
        })

        //select gallery
        gal_input = document.getElementById('gallery_form_input');
        selected_img = document.getElementById('selected_gallery_img');
        function set_gallery(id,media){
            console.log('gona set gallery '+id+media);
            gal_input.value = id;
            selected_img.src = '{{url("/")}}/uploads/imgs/'+media;
        }

        //create gallery

        function create_gallery(form){
             gallery_form = document.getElementById('gallery_new_form')
             let fd = new FormData(gallery_form);
            // console.log(fd)
            //
            // req = new XMLHttpRequest();
            //
            // req.open("POST", "/galleries/create/")
            // req.header()
            // req.success = function (data){
            //     console.log(data)
            // }
            // req.error = function (data){
            //     console.log(data)
            // }
            // req.send(fd);
            //
            //

            $.ajax({
                type: 'PUT',
                url: "http://localhost:8000/galleries/create",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',

                success: function (data){
                    console.log(data)
                    document.getElementById('debuger').innerHTML = data.responseText;

                    set_gallery(data.last_insert_id,data.media)

                   // document.getElementById('gallery_form_input').value = data.last_insert_id;
                },
                error: function (error) {
                    console.log(error)
                    document.getElementById('debuger').innerHTML = error.responseText;

                }
            })


        }
    </script>

    <script> //MANAGES GALLERY FILE INPUTS
        let input_now = 0;



        function show_img(that){ //DISPALYS UPLOADED IMAGE

            img = document.getElementById('prev'+that.id);
            img.src = URL.createObjectURL(that.files[0]);
            console.log(img)
        }

        function add_input (that=0) { //ADDS INPUT

            show_img(that); //DISPALYS NEW IMG

            input_now++;

            console.log(that);


            that.setAttribute('onchange','show_img(this)');// INITALY ADDS add_input, GETS CHANGE TO show_img AFTER FIRST IMG SELECT

            // CRTEATES INPOUT CONTEN
            input = document.createElement('input');
            input.type = 'file';
            input.name = 'media[]';
            input.setAttribute('onchange','add_input(this)');
            input.setAttribute('accept','image/x-png,image/jpeg');
            input.id ='_'+input_now;

            description_lv = document.createElement('textarea');
            description_lv.name = 'description_lv[]';
            that.parentNode.appendChild(description_lv);

            description_ru = document.createElement('textarea');
            description_ru.name = 'description_ru[]';
            that.parentNode.appendChild(description_ru);



            remove_button = document.createElement('div');
            remove_button.classList.add('button_remove');
            remove_button.id = 'remove_'+input_now;
            remove_button.setAttribute('remove',that.id);
            remove_button.setAttribute('onclick','remove_input(this)');
            that.parentNode.appendChild(remove_button);

            prev_img = document.createElement('img');
            prev_img.id = 'prev_'+input_now;
            prev_img.src = '/img/icons/add.png';

            label = document.createElement('label');
            label.setAttribute('for','_'+input_now);
            label.appendChild(prev_img);

            input_wrap=document.createElement('div');
            input_wrap.classList.add('input');
            input_wrap.id = 'input_'+input_now;
            input_wrap.appendChild(label);
            input_wrap.appendChild(input);

            document.getElementById('file_inputs').appendChild(input_wrap)
        }

        function remove_input(that){ //REMOVES INPUT
            console.log(that.getAttribute('remove'));
            let input_wrap = document.getElementById(''+that.getAttribute('remove')).parentNode;
            input_wrap.parentNode.removeChild(input_wrap);
        }
        //SETS UP FIRST INPUT
        first = document.getElementById('_0');
        first.setAttribute('onchange','add_input(this)');
        first.setAttribute('remove','0');


    </script>
@endsection

