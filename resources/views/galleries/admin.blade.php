@extends('layouts.elisanda')
@section('scripts_top')
	<script type="text/javascript">
            in_page = 'galleries';
	</script>
	<?php 
        $lng = Lang::locale();
	 ?>
@endsection
@section('content')
	<div class="container">
		 <div class="paddingH1 marginV1">
            <a class="add" href="{{url('/')}}/galleries/create">{{trans('lang.new_post')}}</a>
        </div>
		<div class="paddingH1 galleries admin flex">
			@foreach($galleries as $gallery)
			<?php $gal = get_object_vars($gallery); ?>
			<?php $media = json_decode($gallery->media);?>
				@if(isset($media[0]))
					<div class="gallery column2">
						<div class="thumb" style="background-image:url(../uploads/imgs/{{$media[0]}}); " onclick="getGallery({{$gallery->id}})"></div>
						<div >
							<div class="links">
								<h3>{{$gal['title_'.$lng]}}</h3>
								<div class="button1">
									<a href="{{url('/')}}/galleries/{{$gallery->id}}/edit" >{{trans('lang.edit')}}</a>
								</div>
								<div class="button1"> 
									<a onclick="getGallery({{$gallery->id}})" class="">{{trans('lang.view')}}</a>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endforeach
		</div>	
		@include('galleries.gallery_preview')
	</div>
@endsection