@extends('layouts.app')
@section('scripts_top')
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/index.css">

	<script type="text/javascript">
		
	</script>
	
@endsection
@section('content')
	<div  class="content_container ">
		<div class="" id="slider_block">
			
		</div> 
		<div class='container sahdow1 container_style1 home_container'>
			<div class="top_form_wrap">
				<h1>{{trans('index.content_heading')}}</h1>
				<h3 class="">{{trans('index.search_ride')}}</h3>
				<form method="post" action="{{url('/')}}/posts">
					@csrf
					@method('options')
					<div id="top_form_inputs" class="flex cc">
						<div class="input_wrap flex">
                            @include('assets.locSelect')
						</div>
						<div  class="input_wrap flex">
								<label for='input_type'>{{trans('index.type')}}</label>
							<div class="input">
								<select type="text" id="input_type" name="type">
									<option value="" selected>All</option>
									<option value="sand">{{trans('index.ground')}}</option>	
									<option value="snow">{{trans('index.snow')}}</option>	
									<option value="water">{{trans('index.water')}}</option>	
									<option value="air">{{trans('index.air')}}</option>	
								</select>
							</div>
							
						</div>
						
						<div  class="input_wrap flex">
							<div class="input">
								<button type="submit" class="button green">{{trans('index.search')}}</button>	
							</div>
						</div>
					</div>
				</form>
			</div>
			<div id="types_wrap" class="flex sahdow1 container_fullscreen_offset">
				<div class="type" ><div id="type_ground" class="bg"></div><div class="cover flex"> <h2>{{trans('index.ground')}}</h2></div></div>
				<div class="type" ><div id="type_snow" class="bg"></div><div class="cover flex"> <h2>{{trans('index.snow')}}</h2></div></div>
				<div class="type" ><div id="type_water" class="bg"></div><div class="cover flex"> <h2>{{trans('index.water')}}</h2></div></div>
				<div class="type" ><div id="type_air" class="bg"></div><div class="cover flex"> <h2>{{trans('index.air')}}</h2></div></div>
			</div>
			<div id="about_wrap" class="margin_v2">
				<div id="about">
					<h2 class="orange light tc">{{trans('index.about_title')}}</h2>
					<p>{{trans('index.about_text')}}</p>
					<div class="button paddingH1 flex">
						<a href="" class="button green">{{trans('index.reed_more')}}</a>
					</div>
				</div>
			</div>
			<div id="how_it_works_wrap" class="full_screen">
				<div  id="how_it_works">
					<div class="container ">
						<h2 class="light tc">{{trans('index.how_it_works')}}</h2>
						<div id="steps" class="flex sb">
							<div class="step" id="step1"><div class="icon"></div><div class="title"><h3>{{trans('index.search')}}</h3></div><div class="description"> <p>{{trans('index.step1_desc')}}</p></div></div>
							<div class="step" id="step2"><div class="icon"></div><div class="title"><h3>{{trans('index.book')}}</h3></div><div class="description"> <p>{{trans('index.step2_desc')}}</p></div></div>
							<div class="step" id="step3"><div class="icon"></div><div class="title"><h3>{{trans('index.ride')}}</h3></div><div class="description"> <p>{{trans('index.step3_desc')}}</p></div></div>
						</div>	
						<div class="button tc"><a href="#" class="button white">{{trans('index.find_ride')}}</a></div>					
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts_bottom')

@endsection