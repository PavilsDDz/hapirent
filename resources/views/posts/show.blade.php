@extends('layouts.app')
@push('scripts_top')
	<script type="text/javascript" src="{{url('/js/ui/jquery-ui.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{url('/js/ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('/js/ui/jquery-ui.structure.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('/js/ui/jquery-ui.theme.min.css')}}">
	<script type="text/javascript" src="{{url('/js/validator.js')}}"></script>


@endpush
@section('scripts_top')
<link rel="stylesheet" type="text/css" href="{{asset('css/posts.css')}}">
<script type="text/javascript">
	var send_search_request = function(search){}
	var move_dispaly = function(){}
	function initMap() {
        var uluru = {{'{lat:'.$post->lat.',lng:'.$post->lng.'}'}};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });


      }
</script>

@section('content')

@if(isset($requested)&&$requested!='')
	{{$requested}}
@endif
<div class="side">
</div>
<div class="container light_box">
	<div class="row justify-content-center" id="posts_conatainer">
		<div class="marginV1">
			<div class="title">
				<h2>{{$post->name}}</h2>
				<h3><a href="{{url('users/'.$author->id)}}">{{$author->name}}</a></h3>
			</div>
			@if(is_array($post->media))
				@include('assets.gallery',['media'=>$post->media])	
			@endif
			<div class="flex block">
				
				<div class="prices">
					
					<table class="prices_table light_box">
						<thead>
							<h4>default prices</h4>
						</thead>
						<tbody>
							
							@foreach($post->prices->default as $default)
							<tr>
								<td>
								{{$default->amount}} {{$default->time}} 
								</td>
								<td>
								{{$default->price}}eur
								</td>						
							</tr>
							@endforeach
						</tbody>
						
					</table>

					@if(count($post->prices->weekend)>0)
					<table class="prices_table light_box">
						<thead>
							<h4>weekend prices</h4>
						</thead>
						<tbody>
							
						@foreach($post->prices->weekend as $weekend)
						<tr>
							<td>
								{{$weekend->amount}} {{$weekend->time}} 
							</td>
							<td>
								{{$weekend->price}}eur
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					@endif
				</div>
				
				<div class="description">
					<p>
						{{$post->description}}
					</p>
				</div>
			
			</div>
		</div>
		<div class="block flex">
			
			<div id="booking_form">
				<form method="POST" action="{{url('/posts')}}/{{$post->id}}" id="mailForm" class="flex column">
					@csrf

					@foreach ($errors->all() as $error)
		                <H1>{{ $error }}</H1>
		            @endforeach
					<input type="hidden" name="post" value="{{$post->id}}">
					<div class="input">
						<div class="lable">your email:</div>
						<input type="text" name="email">
					</div>
					<div class="input">
						<div class="lable">your name:</div>
						<input type="text" name="name">
					</div>
					<div class="input">
						<div class="lable">your phone:</div>
						<input type="text" name="phone">
					</div>
					<div class="input">
						<div class="lable">date:</div>
						@dateInput(date)
						<div id="dateError"></div>
						<!-- <input type="text" name="date" onload="pageLoaded(dateInput(this))"> -->
					</div>
					<div class="input">
						<div class="label">time:</div>
						<select name="hours">
							@for ($i = 0; $i < 24; $i++)
							    <option value="{{$i}}"><?php if($i<10) echo 0; ?>{{$i}}</option>
							@endfor
						</select>
						<select name="minutes">
							<option value="0">00</option>
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="40">40</option>
							<option value="50">50</option>
						</select>
					</div>
					<div class="input">
						<div class="lable">message</div>
						<textarea name="message"></textarea>
					</div>
					<button type="button" class="input button green" id="sendMail" name="sendMail" value="send">
						send
					</button> 
				</form>
			</div>
			<div class="map_wrap">
				<div id="map" ></div>
			</div>
		</div>
		<style type="text/css">
			
		</style>
	</div>
</div>

@endsection

@section('scripts_bottom')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHuLlB9rGRw-LAVatvmmugZrk8JJ9fz3E&callback=initMap"></script>
<script type="text/javascript" src="{{asset('js/gallery.js')}}"></script>
<script type="text/javascript">
					    	$(function(){
					    		$("#mailForm").validate({
									ignore: "",
									rules: {
									    name: {
									      required: true,
									      minlength: 2,
									    },
									    email:{
									    	required: true,
      										email: true,
									    },
									    phone: {
									    	required: true,
									    	minlength:8,
									    	digits:true,
									    },
									    date:{
									    	required: true
									    },
									    hours: {
									    	required: true,
									    }

									},
									messages: {
									    name: {
									      required: "Please write your name",
									      minlength: jQuery.validator.format("At least {0} characters required!"),
									    },
									    email:{
									    	required: "Please add your email",
									    	email: "Please write valid email",
									    },
									    phone: {
									    	required:"Please add your phone",
									    	minlength:"Phone number is to short",
									    	digits: "Phone must contain only digits",
									    },
									    date:{
									    	required:"Please select date and time"
									    },
									    hours:{
									    	required:"Please select date and time"
									    }




									},
									onfocusout: function(that){
									   	$(that).valid()
									},
									onclick: function(that){
										$(that).valid()
									},
									errorPlacement: function(error, element) {
									    if(element.attr("name")=='date' || element.attr("name")=='hours'){
									    	$('#dateError').html(error)
									    } else {
									      error.insertAfter(element);
									    }

									},
					    			submitHandler: function() {},
					    			wrapper: "div",
					    			ignore: ".ignore",
									

					    		})
					    	})
					    	document.getElementById('sendMail').onclick = function(){
					    		console.log($('#mailForm').valid())
					    		if($('#mailForm').valid()){
					    			document.getElementById('mailForm').submit()
					    			// $('#post_add').submit()
					    		}
					    	}
					    </script>
@endsection

@if($booked)
	@push('scripts_bottom')
		<script type="text/javascript">
			new Popup('{{$booked}}')		
		</script>
	@endpush
@endif