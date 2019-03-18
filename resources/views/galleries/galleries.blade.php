@extends('layouts.elisanda')
@section('meta')
    <meta name="title" content='mācību centra "Elisanda" gallerija.'>
    <meta name="keywords" content="semināri, mācības, kursi, skola, apmācības, skaistumkopšana, labsajūta, veselība, čakras ">
    <meta name="description" content='Pilnveido sevi mācību centrā "Elisanda"'>
@endsection
@section('content')
	<div class="container">
		<div class="galleries paddingH1 marginV2 flex cc">
	    @foreach($galleries as $gal)
	    	@if(isset($gal->media[0]))
	    	<div class="gallery" onclick="getGallery({{$gal->id}})">
	    		<div class="img" style="background-image: url({{url('/')}}/uploads/imgs/{{$gal->media[0]}});"></div>
	    		<!-- <img src="{{url('/')}}/uploads/imgs/{{$gal->media[0]}}"> -->
	    		<div class="title">
	    			<h3>{{$gal->title_lv}}</h3>
	    		</div>
	    	</div>	
	    	@endif	
	    @endforeach
	    </div>
	</div>	
	    @include('galleries.gallery_preview')
@endsection
@section('scripts_top')
	<script type="text/javascript">
            in_page = 'galleries';
    </script>
@endsection