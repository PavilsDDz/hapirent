@extends('layouts.app')

@section('subnav')		
@endsection

@section('content')
	
<div class="flex" id="posts_viewer">
	<div class="container paddingH1 flex" id="posts_wrap">
		<div class="side light_box">
			@include('filters.large_filters_form',[])
		</div>

		@include('posts.posts')

		
	</div>
</div>
@endsection
