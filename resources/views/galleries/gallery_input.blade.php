<div id="gallery_input" class="form_content">
  <div class="">
    <h2>{{trans('edit.new_gal')}}</h2>
  </div>
 <div id="gallery_new">
   <form id="gallery_new_form" enctype="multipart/form-data" onsubmit="">
    @csrf
    @method('put')

    <div class="flex sb">
      <div class="input flex column column2">
       <label for="gallery_title_lv">gallery_title Lv:</label> <input id="gallery_title_lv" type="text" name="title_lv">
      </div>
      <div class="input flex column column2">
       <label for="gallery_title_ru">gallery_title Ru:</label> <input id="gallery_title_ru" type="text" name="title_ru">
      </div>
    </div>

    <div class="flex sb">
      <div class="input flex column column2">
        <label>{{trans('lang.description')}} LV</label>
        <textarea name="gallery_description_lv" id="gallery_description_lv" cols="30" rows="10"></textarea>
      </div>
      <div class="input flex column column2">
        <label>{{trans('lang.description')}} RU</label>
        <textarea name="gallery_description_ru" id="gallery_description_ru" cols="30" rows="10"></textarea>
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
    
    <label for="dependent">{{trans('lang.independent')}}</label><input type="checkbox"  id="dependent" name="dependent">
    <input type="hidden" name="ajax" value=1>
    <button type="button" class="apply1" onclick="create_gallery()">izveidot</button>

   </form>
 </div>

  <div id="gallery_select">
    <div class="">
      <h2>{{trans('edit.select_gal')}}</h2>
    </div>
    <div class="galleries_select flex">
     @forelse($galleries as $gallery)
      @if(isset($gallery->media[0]))
      <div class="gallery flex">
       <div class="thumb_small">
        <div class="short_info">
         <span onclick="getGallery({{$gallery->id}})" >{{trans('lang.view')}}</span>
         <span onclick="set_gallery({{$gallery->id}},'{{$gallery->media[0]}}')">{{trans('lang.use')}}</span>
         <h5>{{$gallery->title_lv}}</h5>
         <p>{{$gallery->description_lv}}</p>
        </div>
        <div class="img">
         <img src="{{url('/uploads/imgs').'/'.$gallery->media[0]}}" alt="">
        </div>
       </div>
      </div>
      @endif
     @empty
      <p>no galleries</p>
     @endforelse
     </div>
  </div>
</div>
