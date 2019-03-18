@extends('layouts.elisanda')
@section('scripts_top')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/froala_editor.css">
    <link rel="stylesheet" href="{{url('/')}}/css/froala_style.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/code_view.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/draggable.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/colors.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/emoticons.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/image_manager.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/image.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/line_breaker.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/table.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/char_counter.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/video.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/fullscreen.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/file.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/quick_insert.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/help.css">
    <link rel="stylesheet" href="{{url('/')}}/css/third_party/spell_checker.css">
    <link rel="stylesheet" href="{{url('/')}}/css/text_plugins/special_characters.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
    <script type="text/javascript" src="{{url('/')}}/js/jquery.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <script type="text/javascript">
            in_page = 'programs_admin';
    </script>

@endsection
@section('content')



    <form action="{{url('programms/create')}}" method="POST">
        @csrf
        @method('put')
        <div class="paddingV1">


            <div class="flex paddingH1 sb">
              <div class="input flex column column2">
               <label for="title_lv">{{trans('lang.title')}} Lv:</label><input type="text" name="title_lv" ><br>
               <label class="">{{trans('lang.short_descrtiption')}} Lv:</label>
                <div id="shortDisc_lv"></div>
                <input id="shortDisc_lv_input" type="hidden" name="shortDisc_lv" value="">
              </div>
              <div class="input flex column column2">
               <label for="title_ru">{{trans('lang.title')}} Ru:</label><input type="text" name="title_ru"><br>
               <label class="">{{trans('lang.short_descrtiption')}} Ru:</label>
                <div id="shortDisc_ru"></div>
                <input id="shortDisc_ru_input" type="hidden" name="shortDisc_ru" value="">
                
             </div>
            </div>


            
            <input type="hidden" value="" name="description_lv" id="description_lv">
           
            <input type="hidden" value="" name="description_ru" id="description_ru">
            <div class="paddingV1">
                
              <div id="lang_switch" lang_wrap="">
                        <div class="controls">
                            <button type="button" id="lang_lv" class="button1 active">latviski</button>
                            <button type="button" id="lang_ru" class="button1">krieviski</button>
                        </div>
                    </div>

                <div id="editor">
                    <div id='edit' style="margin-top: 10px;">
                    </div>
                </div>

            </div>
            <div class="flex cc paddingV1" id="gallery_edit_controls">
                <div>
                    <span  id="add_galery" class="button1">{{trans('lang.add_gallery')}}</span>
                    <span  id="remove_galery" class="button1">{{trans('lang.remove_gallery')}}</span>
                </div>
                <div class="">
                    <img src="{{url('/')}}/img/icons/no-img.jpg" id="selected_gallery_img" alt="">
                    
                </div>
                <input type="hidden" id="gallery_form_input" name="gallery" value="">
            </div>
                

            <div>
                <button type="submit" name="submit" class="submit" value="true">{{trans('lang.create')}}</button>
            </div>

        </div>
    </form>
    <div id="galleries_wrap">
        <!-- {{--{{dd($galleries)}}--}} -->
        @include('galleries.gallery_input')
    </div>
    <div id="debuger">   </div>
    @include('galleries.gallery_preview')
@endsection
@section('scripts_bottom')
    <style>
    body {
        text-align: center;
    }

    #editor {
        width: 81%;
        margin: auto;
        text-align: left;
    }

    .ss {
        background-color: red;
    }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

    <script type="text/javascript" src="{{url('/')}}/js/froala_editor.min.js" ></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/align.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/code_view.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/colors.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/draggable.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/entities.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/file.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/font_size.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/font_family.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/image.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/link.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/lists.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/quote.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/table.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/save.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/url.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/video.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/help.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/print.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/third_party/spell_checker.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/special_characters.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/text_plugins/word_paste.min.js"></script>

    <script>
        $(function(){
            $('#edit').froalaEditor()
            $('#shortDisc_lv').froalaEditor()
            $('#shortDisc_ru').froalaEditor()
        });
    </script>

    <script>
        //LANGUAGE SWITCH
        let lang = 'lv';
        let myElement = document.getElementById('edit');

        $('#edit').on('froalaEditor.keypress', function (e, editor, keypressEvent) {
            contentChanged();
        });
        $('#edit').on('froalaEditor.paste.after', function (e, editor) {
            contentChanged();
        });
        $('#edit').on('froalaEditor.blur', function (e, editor) {
            contentChanged();
        });
            
        $('#shortDisc_ru').on('froalaEditor.keypress', function (e, editor, keypressEvent) {
            shortDisc('ru');
        });
        $('#shortDisc_ru').on('froalaEditor.paste.after', function (e, editor) {
            shortDisc('ru');
        });
        $('#shortDisc_ru').on('froalaEditor.blur', function (e, editor) {
            shortDisc('ru');
        });

        $('#shortDisc_lv').on('froalaEditor.keypress', function (e, editor, keypressEvent) {
            shortDisc('lv');
        });
        $('#shortDisc_lv').on('froalaEditor.paste.after', function (e, editor) {
            shortDisc('lv');
        });
        $('#shortDisc_lv').on('froalaEditor.blur', function (e, editor) {
            shortDisc('lv');
        });
        // if(window.addEventListener) {
        //     // Normal browsers
        //     myElement.addEventListener('DOMSubtreeModified', contentChanged, false);
        // } else
        // if(window.attachEvent) {
        //     // IE
        //     myElement.attachEvent('DOMSubtreeModified', contentChanged);
        // }
        function shortDisc(ln){
            
            html = $('#shortDisc_'+ln).froalaEditor('html.get');
            document.getElementById('shortDisc_'+ln+'_input').value = html;
            console.log(document.getElementById('shortDisc_'+ln+'_input').value)

        }

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
           console.log('LV')
            swithc_lang('lv')
            switch_active(this)
                
        })
        document.getElementById('lang_ru').addEventListener('click',function () {
            console.log('LV')
            swithc_lang('ru')
            switch_active(this)

        })
    </script>
    <script>
        //GALLERIES script
        document.getElementById('add_galery').onclick = function(){
            let gal_input = document.getElementById('gallery_input')
            let gal_display_now = gal_input.style.display = 'block'
            console.log(gal_input.style)
        }
        //select gallery
        gal_input = document.getElementById('gallery_form_input');
        selected_img = document.getElementById('selected_gallery_img');
        function set_gallery(id,media){
            console.log('gona set gallery '+id+media);
            gal_input.value = id;
            selected_img.src = '{{url("/")}}/uploads/imgs/'+media;

              console.log('gona set gallery '+id+media);
            gal_input.value = id;
            selected_img.src = '{{url("/")}}/uploads/imgs/'+media;

            document.getElementById('file_inputs').innerHTML = 
            `<div class="input" id="input_0">
                <label for="_0">
                    <img src="{{url('/')}}/img/icons/add.png" alt="" id="prev_0" onclick="">
                </label>
                <input type="file" accept="image/x-png,image/jpeg"  id="_0" name="media[]">
            </div>`;
        
            document.getElementById('gallery_description_ru').value = '';
            document.getElementById('gallery_description_lv').value = '';
            document.getElementById('gallery_title_ru').value = '';
            document.getElementById('gallery_title_lv').value = '';
            
            document.getElementById('gallery_input').style.display = 'none'; // gallery_title_ru
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
                url: "{{url('/')}}/galleries/create",

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

