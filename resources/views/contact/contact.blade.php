@extends('layouts.elisanda')
@section('meta')
    <meta name="title" content='mācību centra "Elisanda" kontakti'>
    <meta name="keywords" content="semināri, mācības, kursi, skola, apmācības, skaistumkopšana, labsajūta, veselība, čakras ">
    <meta name="description" content='Kontaktējies ar mums, lai pilnveidotu sevi mācību centrā "Elisanda"'>
@endsection
@section('popup')
	@if(Session::has('status'))
	    <script type="text/javascript">
	            popup.style.display ='block'
	    </script>
	   
	        <div id="mail_mesage" class="popup_mesage shadow1">
	                <div class="close"></div> 
	            <div class="text">
	                <p>{{trans('lang.email_sent')}}</p>

	               <!--     @if(Session::get('status')=='sent')
	                <p>{{trans('lang.email_sent')}}</p>
	                @else 
	                <p>{{trans('lang.email_error')}}</p>

	                @endif -->
	            </div>
	        </div>
	@endif
@endsection
@section('content')
	<div class="paddingV1 block"></div>
	<div class="paddingH1 ">
		<h2 class="paddingH1">{{trans('lang.apply_form')}}</h2>
	</div>
	<form class="paddingH1 marginV2" method="post" action="{{url('/')}}/contacts">
		@csrf
		<div class="flex mob_col sb paddingH1">
			<div class=" column2 column flex">
				<label>{{trans('lang.name')}}</label>
				<input type="text" name="name">
			</div>
			<div class=" column2 column flex">
				<label>{{trans('lang.surname')}}</label>
				<input type="text" name="surname">
			</div>
		</div>
		<div class="flex mob_col sb paddingH1">
			<div class=" column2 column flex">
				<label>{{trans('lang.adress')}}</label>
				<input type="text" name="adress">
			</div>
			<div class=" column2 column flex">
				<label>{{trans('lang.phone_numder')}}</label>
				<input type="text" name="phone">
			</div>
		</div>
		<div class="flex mob_col sb paddingH1">
			<div class=" column2 column flex">
				<label>{{trans('lang.email')}}</label>
				<input type="text" name="email">
			</div>
			<div class=" column2 column flex">
				<label>{{trans('lang.chose_program')}}</label>
				<select name="program">
					@foreach($prg as $program)
						<option value="{{$program->title_lv}}">{{$program->title_lv}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="flex sb paddingH1">
			<div class="column flex block">
				<label>{{trans('lang.message')}}</label>
				<textarea name="message"></textarea>
			</div>
			
		</div>
		<div class="block input flex cc">
			<button type="submit" class="submit" value="send" name="submit">{{trans('lang.send')}}</button>
		</div>
	</form>
	<div class="flex mob_col paddingH1 marginV1"> 
			<ul class="credentials">
				<li><h3>{{trans('lang.educational_center')}}  <b>"ELISANDA"</b></h3></li>
				<li class="flex"><div class="name">{{trans('lang.adress')}}:</div ><div class="value">Ģertrūdes iela 54-7, Rīga</div></li>
				<li class="flex"><div class="name">{{trans('lang.phone')}}</div ><div class="value">67551422</div></li>
				<li class="flex"><div class="name">{{trans('lang.mob_phone')}}</div ><div class="value">29507347</div></li>
				<li class="flex"><div class="name">{{trans('lang.email')}}:</div ><div class="value">elisanda@elisanda.lv</div></li>
			</ul>
			<div id="map">
				
			</div>
			 <script>
		      var map;
		      function initMap() {
		        map = new google.maps.Map(document.getElementById('map'), {
		          center: {lat: 56.952290, lng: 24.131492},
		          zoom: 16
		        });
		         var marker = new google.maps.Marker({
		          position: {lat: 56.952290, lng: 24.131492},
		          map: map
		        });
		      }
		    </script>
		     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRq2rAaewHXzwdqIuK3J2wOCBJZDzmyaE&callback=initMap" async defer></script>
	</div>
	<form >

	</form>
		
@endsection
@section('scripts_top')
	<script type="text/javascript">
            in_page = 'contacts';
    </script>
@endsection

