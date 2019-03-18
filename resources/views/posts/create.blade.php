@extends('layouts.app')

@push('scripts_top')
	<link rel="stylesheet" type="text/css" href="{{url('/css/posts.css')}}">
	<script type="text/javascript" src="{{url('/js/validator.js')}}"></script>
@endpush
@section('content')
<div class="container row">

	<div class="row justify-content-center ">
		<form method="POST" id="post_add" action="/posts" enctype="multipart/form-data" class="">
			{{csrf_field()}}
			<div class="form-group">

				<div class="input flex">
					<label for="name"></label>
					<div for="name" class="label">Name </div>
					<input id="name" type="text" name="name">
				</div>

				<div class="input flex">
					<div for="type" class="label">Type </div>
					<select id="type" name="type">
						<option value=""></option>
						<option value="snow">snow</option>
						<option value="water">water</option>
						<option value="air">air</option>
						<option value="ground">ground</option>
					</select>
				</div>
				
				<div class="input flex">
					<div for="description" class="label">Description </div>
					<textarea id="description" type="text" name="description"></textarea>
				</div>
<!-- 
				<div class="checkbox input">
					<label>license required:</label>
					<input type="checkbox" name="license" id="license">
				</div>

				<div class="input" id="">
					<label>license type:</label>
					<input type="text" id="licenseType" name="licenseType">
				</div> -->
				
				
					<input id="lat" type="hidden" name="lat">
					<input id="lng" type="hidden" name="lng">
				<div class="input">
					
						<label for="media" class="">media </label>

					<div id="file_inputs" class="flex">
							    <div  id="input_0" class="input_pic">
							    	<label for="_0">
							       		<img src="/img/camera_green.svg" alt="" id="prev_0" onclick="">
							      	</label>
							      	<input type="file" accept="image/x-png,image/jpeg"  id="_0" name="media[]">

							    </div>
					</div>
				</div>
				<!-- <div class="">
					<input id="media" type="file" multiple name="media[]">
					<input id="media" type="file" multiple name="media[]">
					<input id="media" type="file" multiple name="media[]">
				</div> -->
					<div id="priceError"></div>
				<div id="price_range" class="marginV1">

					<div class="price_create flex" id="defaultPriceSelecet">
						<div class="input">
							<label>time scale</label>
							<select id="defaultTimes" class="ignore">
								<option value="minutes" >minutes</option>
								<option value="hours" >hours</option>
								<option value="days" >days</option>
								<option value="weekend" >weekend</option>
								<option value="working" >working days</option>
							</select>
						</div>
						<div>
							
						</div>
						
						<div class="input">
							<label>amount</label>
							<input type="number" id="defaultAmount" class="ignore">
						</div>
						<div class="input">
							<label>price EUR</label>
							<input id="defaultPrice" type="number" onblur="price(this)" class="ignore" step="0.01">
						</div>
						<div class="input">
							<button type="button" onclick="PricesAdd('default')" class="button_add"></button>
						</div>

					</div>
					<div id="split_wrap">
						<label for="split">diferent prices in weekends</label>
						<input type="checkbox" id="split" onchange="splitTable(this)" name="split">
					</div>
					<div class="price_create flex" id="weekendPriceSelect" >
						<div class="input">
							<label>time scale</label>
							<select id="weekendTimes">
								<option value="minutes">minutes</option>
								<option value="hours">hours</option>
								<option value="days">days</option>
							</select>
						</div>
						<div class="input">
							<label>amount</label>
							<input type="number" id="weekendAmount">
						</div>
						<div class="input">
							<label>price</label>
							<input id="weekendPrice" type="number" onblur="price(this)" step="0.01">
						</div>
						<div class="input">
							<button type="button" onclick="PricesAdd('weekend')" class="button_add"> </button>
						</div>
							
					</div>
					<input type="hidden" id="Prices" name="prices">
					
				</div>
				<div id="pricesTables">
					<div class="pricesTable" id="defaultTable">
					<div><h3 class="textc paddingV3">default prices</h3></div>
						<table>
							<thead>
								<tr>
									<th>time</th>
									<th>price</th>
									<th>edit</th>
								</tr>	
							</thead>
							<tbody id="defaultPricesData">
								
							</tbody>
							
								
						</table>
					</div>
					<div class="pricesTable" id="weekendTable">
						
						<div><h3 class="textc paddingV3">weekend prices</h3></div>
						<table>
							<thead>
								<tr>
									<th>time</th>
									<th>price</th>
									<th>edit</th>
								</tr>	
							</thead>
							<tbody id="weekendPricesData">
								
							</tbody>
							
								
						</table>
					</div>
				</div>
				<!-- <label for="day">Rental price per day</label>
				<div class="">
					<input id="day" type="number" onblur="price(this)" name="day" step="0.01">
				</div>

				<label for="hour">Rental price per hour</label>
				<div class="">
					<input id="hour" onblur="price(this)" type="number" name="hour" step="0.01">
				</div> -->
			</div>
		</form>
	</div>

	<div class="marginV1">		
		<p>pick rental place</p>
		<div id="posError"></div>
		<div id="mappp" style="width: 100%; height: 400px"></div>
	</div>
	<div class="margin_v2 tc">
		<button type="submit" id="submit" class="submit button button green" onclick="//document.getElementById('post_add').submit()" name="submit"> Save</button>
	</div>

</div>



					    
					   



@endsection

@section('scripts_top')
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <script src="{{url('/')}}/js/priceselect.js"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/create.css">
@endsection

@section('scripts_bottom')
    <script type="text/javascript" src="{{url('/')}}/js/mediaadd.js"></script>
						<script type="text/javascript">
							var current_loc = false; 
							function getLocation() {
							    if (navigator.geolocation) {
							        navigator.geolocation.getCurrentPosition(showPosition);
							    } else { 
							        x.innerHTML = "Geolocation is not supported by this browser.";
							    }
							}

							function showPosition(position) {
							    // x.innerHTML = "Latitude: " + position.coords.latitude + 
							    // "<br>Longitude: " + position.coords.longitude;
							    current_loc = {lat:position.coords.latitude,lng:position.coords.longitude}
							    console.log(current_loc)
							    initMap()
							}
							// getLocation()
						</script>

						<script type="text/javascript">
							function price(a){
								x = parseFloat(a.value).toFixed(2)
								a.value = x
							}
						</script>
					    <script>

					      var map;
					      var marker;
					      var infowindow;
					      var messagewindow;

					      function initMap() {
					        var riga = {lat: 56.950891, lng: 24.117868}
					        current_loc?1:current_loc=riga
					      	console.log(current_loc)
					        map = new google.maps.Map(document.getElementById('mappp'), {
					          center: current_loc,
					          zoom: 13
					        });

							console.log(map)

					        infowindow = new google.maps.InfoWindow({
					          content: document.getElementById('form')
					        });

					        messagewindow = new google.maps.InfoWindow({
					          content: document.getElementById('message')
					        });
					       	var marker = false
					       // marker = new google.maps.Marker({
					       //      position: current_loc,
					       //      map: map
					       //  });

					        google.maps.event.addListener(map, 'click', function(event) {
					        	marker = marker?marker:
					          new google.maps.Marker({
					            position: event.latLng,
					            map: map
					          });

					          marker.setPosition(event.latLng)

					         // document.getElementById('loc').value = JSON.stringify( event.latLng.toJSON())
					         document.getElementById('lat').value = event.latLng.toJSON().lat
					         document.getElementById('lng').value = event.latLng.toJSON().lng
					         console.log(event.latLng.toJSON().lat,event.latLng.toJSON().lng)




					          google.maps.event.addListener(marker, 'click', function() {
					            infowindow.open(map, marker);
					          });
					        });
					      }

					      function saveData() {
					        var name = escape(document.getElementById('name').value);
					        var address = escape(document.getElementById('address').value);
					        var type = document.getElementById('type').value;
					        var latlng = marker.getPosition();
					        var url = 'phpsqlinfo_addrow.php?name=' + name + '&address=' + address +
					                  '&type=' + type + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();

					        // downloadUrl(url, function(data, responseCode) {

					        //   if (responseCode == 200 && data.length <= 1) {
					        //     infowindow.close();
					        //     messagewindow.open(map, marker);
					        //   }
					        // });
					      }

					      function downloadUrl(url, callback) {
					        var request = window.ActiveXObject ?
					            new ActiveXObject('Microsoft.XMLHTTP') :
					            new XMLHttpRequest;

					        request.onreadystatechange = function() {
					          if (request.readyState == 4) {
					            request.onreadystatechange = doNothing;
					            callback(request.responseText, request.status);
					          }
					        };

					        request.open('GET', url, true);
					        request.send(null);
					      }

					      function doNothing () {
					      }




					      console.log(document.getElementById('mappp').innerHTML)
					      function mapreload(){

					      	if (document.getElementById('mappp').innerHTML.length<500) {
					      		console.log('map not loanched')
					      		initMap()
					      		setTimeout(function(){
							      	mapreload()
							     },500)

					      	}else{
					      		console.log('map Lonched')
					      	}
					      }

					      setTimeout(function(){
					      	mapreload()
					      },500)

					    </script>


					    <script type="text/javascript">
					    	$(function(){
					    		$("#post_add").validate({
									ignore: "",
									rules: {
										lat:{
											required:true
										},
										lng:{
											required:true
										},
									    name: {
									      required: true,
									      minlength: 2
									    },
									    type:{
									    	required:true
									    },
									    prices: {
									    	required: true
									    },


									},
									messages: {
									    name: {
									      required: "We need your email address to contact you",
									      minlength: jQuery.validator.format("At least {0} characters required!")
									    },
									    type: {
									    	required: "Please chouse type"
									    },
									    prices:{
									    	required: "Please add atleastr one price"
									    },
									    lat:{
											required:"Pick location for your rentable"
										},
										lng:{
											required:"Pick location for your rentable"
										},



									},
									onfocusout: function(that){
									   	$(that).valid()
									},
									onclick: function(that){
										$(that).valid()
									},
									errorPlacement: function(error, element) {
									    if (element.attr("name") == "prices") {
									    	$('#priceError').append(error)
									      // error.insertAfter("#lastname");
									    }if(element.attr("name")=='lat' || element.attr("name")=='lng'){
									    	$('#posError').html(error)
									    } else {
									      error.insertAfter(element);
									    }

									},
					    			submitHandler: function() {},
					    			wrapper: "div",
					    			ignore: ".ignore",
									

					    		})
					    	})
					    	document.getElementById('submit').onclick = function(){
					    		console.log($('#post_add').valid())
					    		if($('#post_add').valid()){
					    			document.getElementById('post_add').submit()
					    			// $('#post_add').submit()
					    		}
					    	}
					    </script>
					    <script async defer
					    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXhlt4YHvLGX-6FKwOhDzBrK8mHXdWoCo&callback=getLocation">
					    </script>
@endsection
