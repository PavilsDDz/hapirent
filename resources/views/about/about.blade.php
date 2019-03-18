@extends('layouts.elisanda')
@section('meta')
    <meta name="title" content='par mācību centru "Elisanda"'>
    <meta name="keywords" content="semināri, mācības, kursi, skola, apmācības, skaistumkopšana, labsajūta, veselība, čakras ">
    <meta name="description" content='Pilnveido sevi mācību centrā "Elisanda"'>
@endsection
@section('content')
<div class="paddingH1 about">
	<div class="paddingH1">
		
		<h2 class="textc">{{trans('lang.waiting_for')}}</h2>
		<p class="textj marginV1">{{trans('lang.about1')}}</p>
		<h3>{{trans('lang.why_elisanda')}}</h3>
		<div class="marginV1">
			{!! trans('lang.about2')!!}
		</div>
	</div>
	<div class="">
	@include('galleries.gallery_include')
		
	</div>
		
</div>
@endsection
@section('scripts_top')
	<script type="text/javascript">
            in_page = 'about';
    </script>
@endsection
