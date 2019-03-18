@extends('layouts.elisanda')
<?php $gallery = get_object_vars($gal);
        $lng = Lang::locale();
?>
@section('scripts_top')
    <script type="text/javascript">
            in_page = 'galleries';
    </script>
@endsection
@section('content')
    <div class="paddingH1">
        <h2>{{trans('lang.edit_gallery')}} {{$gallery['title_'.$lng]}}</h2>
    </div>
    <form action="{{url('/')}}/galleries/{{$gallery['id']}}/edit" class="paddingH1" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
         <div class="flex sb">
      <div class="input flex column column2">
       <label for="gallery_title_lv">{{trans('lang.gallery_title')}} Lv:</label> <input id="gallery_title_lv" type="text" name="title_lv" value="{{$gallery['title_lv']}}">
      </div>
      <div class="input flex column column2">
       <label for="gallery_title_ru">{{trans('lang.gallery_title')}} Ru:</label> <input id="gallery_title_ru" type="text" name="title_ru" value="{{$gallery['title_ru']}}">
      </div>
    </div>

    <div class="flex sb">
      <div class="input flex column column2">
        <label>{{trans('lang.description')}} LV</label>
        <textarea name="gallery_description_lv" id="" cols="30" rows="10">{{$gallery['description_lv']}}</textarea>
      </div>
      <div class="input flex column column2">
        <label>{{trans('lang.description')}} RU</label>
        <textarea name="gallery_description_ru" id="" cols="30" rows="10">{{$gallery['description_ru']}}</textarea>
      </div>
    </div>

        <div id="file_inputs">
        	<?php 
        	$i = 0; 
        	$md = json_decode($gallery['media_description']);
        	// $md_lv = json_decode($md->lv);
        	// $md_ru = json_decode($md->ru);
        	//print_r($md);
        	?>
        	
        	@foreach(json_decode($gal->media) as $media)
            <div class="input" id="input_{{$i}}">
                <label for="_{{$i}}">
                    <img src="{{url('/')}}/uploads/imgs/{{$media}}" alt="" id="prev_{{$i}}" nr="{{$i}}" onclick="">
                </label>
                <input type="file" accept="image/x-png,image/jpeg" nr="{{$i}}" onchange = "change_img(this)"  id="_{{$i}}" name="media_replace[]">
                <textarea name="description_lv[]">@if(isset($md->lv[$i])){{$md->lv[$i]}}@endif</textarea>
                <textarea name="description_ru[]">@if(isset($md->ru[$i])){{$md->ru[$i]}}@endif</textarea>
                <div class="button_remove" id="remove_{{$i}}" remove="_{{$i}}" onclick="remove_input(this);add_to_removed({{$i}})"></div>
            </div>
            <?php $i++; ?>
            @endforeach
	            <div class="input" id="input_{{$i}}">
	                <label for="_{{$i}}">
	                    <img src="{{url('/')}}/img/icons/add.png" alt="" id="prev_{{$i}}" onclick="">
	                </label>
	                <input type="file" accept="image/x-png,image/jpeg"  id="_{{$i}}" name="media[]">

	       		</div>
           </div>
          <input type="hidden" name="id" value="{{$gallery['id']}}">
        <input type="hidden" id="changed_input"  name="changed">
        <input type="hidden" name="remove" id="remove_array">
        <input type="hidden" name="ajax" value=0 >
        <div class="input">
        	
	        <label for="dependent_input">dependemny</label>
        @if($gal->dependent == 1)
	        <input type="checkbox" name="dependent" id="dependent_input" checked="true">
        @else
	        <input type="checkbox" name="dependent" id="dependent_input">
        @endif
        </div>
        <button type="submit" class="apply2">{{trans('edit.save')}}</button>

    </form>

@endsection
@section('scripts_bottom')

    <script>
        let input_now = {{$i}};
        let changed = [];
        for (var i = 0; i < input_now; i++) {
        	changed[i] = []
        }
        function show_img(that){
        	 img = document.getElementById('prev'+that.id);
            img.src = URL.createObjectURL(that.files[0]);
        }


        function change_img(that){ //DISPALYS UPLOADED IMAGE

            img = document.getElementById('prev'+that.id);
            img.src = URL.createObjectURL(that.files[0]);
            ind = that.getAttribute('nr')
          	changed[ind] = that.files[0].name
            document.getElementById('changed_input').value = JSON.stringify(changed)
          //  console.log(that.files[0])
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

            console.log(input_wrap)

            document.getElementById('file_inputs').appendChild(input_wrap)

        }
        let removed = []
       	function add_to_removed(i){
       		removed.push(i)
       		document.getElementById("remove_array").value = JSON.stringify(removed)
        }
        function remove_input(that){ //REMOVES INPUT
            console.log(that.getAttribute('remove'));
           let input_wrap = document.getElementById(''+that.getAttribute('remove')).parentNode;
           input_wrap.parentNode.removeChild(input_wrap);
        }
        //SETS UP FIRST INPUT
        first = document.getElementById('_{{$i}}');
        first.setAttribute('onchange','add_input(this)');
        first.setAttribute('remove','{{$i}}');




    </script>
@endsection