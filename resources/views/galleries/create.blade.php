@extends('layouts.elisanda')
@section('scripts_top')
    <script type="text/javascript">
            in_page = 'galleries';
    </script>
@endsection
@section('content')
    <div class="paddingH1">
        <h2>{{trans('lang.new_gallery')}}</h2>
    </div>
    <form action="{{url('galleries/create')}}" class="paddingH1" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
         <div class="flex sb">
      <div class="input flex column column2">
       <label for="gallery_title_lv">{{trans('lang.gallery_title')}} Lv:</label> <input id="gallery_title_lv" type="text" name="title_lv">
      </div>
      <div class="input flex column column2">
       <label for="gallery_title_ru">{{trans('lang.gallery_title')}} Ru:</label> <input id="gallery_title_ru" type="text" name="title_ru">
      </div>
    </div>

    <div class="flex sb">
      <div class="input flex column column2">
        <label>{{trans('lang.description')}} LV</label>
        <textarea name="gallery_description_lv" id="" cols="30" rows="10"></textarea>
      </div>
      <div class="input flex column column2">
        <label>{{trans('lang.description')}} RU</label>
        <textarea name="gallery_description_ru" id="" cols="30" rows="10"></textarea>
      </div>
    </div>

        <div id="file_inputs">
            <div class="input" id="input_0">
                <label for="_0">
                    <img src="{{url('/')}}/img/icons/add.png" alt="" id="prev_0" onclick="">
                </label>
                <input type="file" accept="image/x-png,image/jpeg"  id="_0" name="media[]">

            </div>
        </div>
        <input type="hidden" name="ajax" value=0>
        <button type="submit" class="apply2">{{trans('edit.save')}}</button>

    </form>

@endsection
@section('scripts_bottom')

    <script>
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
            prev_img.src = '{{url('/')}}/img/icons/add.png';

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