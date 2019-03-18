@extends('layouts.elisanda')
<?php $pgr = get_object_vars($program);$lng = Lang::locale(); ?>
@section('meta')
    <meta name="title" content="{{$pgr['title_'.$lng]}} mācību programma">
    <meta name="keywords" content="{{$pgr['title_'.$lng]}}, semināri, mācības, kursi, skola, apmācības, skaistumkopšana, labsajūta, veselība, čakras ">
    <meta meta="description" content="Apgūsti programmu {{$pgr['title_'.$lng]}} un pilnveido sevi mācību centrā Elisanda.">
@endsection
@section('scripts_top')
    <script type="text/javascript">
            in_page = 'programs';
    </script>
@endsection
@section('content')
    <div class="container">
		<div class="info paddingH1">
			<div class="title">
				<h2>{{$pgr['title_'.$lng]}}</h2>
				<div class="description">
					{!!$pgr['description_'.$lng]!!}
				</div>
              
			</div>
		</div>
        <div class="gallery_container paddingH1">
            @if($gal)
                @include('galleries.gallery_include')
            @endif 
        </div>
    </div>
    
    
@endsection
@section('scripts_top')
	<script type="text/javascript" src="{{url('/')}}/js/hammer.js"></script>
    <script type="text/javascript">
            in_page = 'programs';
    </script>
@endsection
