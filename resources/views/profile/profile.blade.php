@extends('layouts.app')

@section('scripts_top')
	<link rel="stylesheet" href="{{url('/')}}/css/profile.css">
	<link rel="stylesheet" type="text/css" href="{{url('/css/posts.css')}}">
@endsection

@push('scripts_top')
<script type="text/javascript">
	
	$(function(){
			let dir = 1
		$('#map_toggle').click(function(){
			console.log('test')
			let map = $('#DispalyMapWrap')
			let w = map.width()
			let list = $('#posts_conatainer')
			ww = window.innerWidth

			if(dir){
				map.css('display','block')
				$(this).addClass('active')
				list.css('display','none')
			}else{
				map.css('display','none')
				$(this).removeClass('active')
				list.css('display','block')
			}

				dir = dir?0:1
			
		})
	})
</script>
@endpush

@section('content')
	<div class="container flex" id="profile">

		@php 
			$editable = (isset($myProfile)&&$myProfile);
		@endphp

		@component('assets.profileCard',array('user'=>$user,'myProfile'=>$editable,'posts'=>count($posts)))
		@endcomponent

		@include('posts.posts')

	</div>
@endsection

@push('scripts_bottom')
	
	<script type="text/javascript">
		inputs['user_id'] = '{{$user->id}}'
		inputs['myPosts'] = 'true'
		postRequest(inputs)
	</script>
@endpush
