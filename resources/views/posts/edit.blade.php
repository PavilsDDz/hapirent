@extends('layouts.app')
@push('scripts_top')
	<link rel="stylesheet" type="text/css" href="{{url('/css/create.css')}}">
	<script type="text/javascript" src="{{url('/js/validator.js')}}"></script>
@endpush

@section('content')
<div class="container row" id="post_edit">
				

	<div class="row justify-content-center col-md-6">
		<div class="flex">
			<button class="button red" id="delete">delete</button>
		</div>
		<form method="POST" action="/posts/{{$post->id}}" id="form" enctype="multipart/form-data" class="col-md-12">
			{{method_field('PUT')}}
			{{csrf_field()}}
			<div class="form-group">
				<div class="input flex">
					<div for="name" class="label">Name </div>
					<input id="name" value="{{$post->name}}" type="text" name="name">
				</div>

				<div class="input flex">
					<div for="type" class="label">Type </div>
					<select id="type" name="type">
						<option value=""></option>
						<option value="snow" <?php if($post->type==0){echo "selected";} ?>>snow</option>
						<option value="water" <?php if($post->type==1){echo "selected";} ?>>water</option>
						<option value="ground" <?php if($post->type==2){echo "selected";} ?>>ground</option>
						<option value="air" <?php if($post->type==4){echo "selected";} ?>>air</option>
					</select>
				</div>

				<div class="input flex">
					<div for="description" class="label">Description </div>
					<textarea id="description" type="text" name="description">{{$post->description}}</textarea>
				</div>

				
				<?php 
					$media = json_decode($post->media);
					$i=0;
				?>
						
				<div class="input">
					
						<label for="media" class="">media </label>

					<div id="file_inputs" class="flex">
						@foreach($media as $m)
							<div  id="input_{{$i}}" class="input_pic">
							   		<div class="button_remove" remove="{{$i}}" id="remove_{{$i}}" onclick='remove_input(this)'"></div> <?php // button structure has to be the same as in addmedia.js?>
							   	<label for="_{{$i}}">
							   		<img src="{{url('/')}}/images/{{$m}}" alt="" id="prev_{{$i}}" onclick="">
							   	</label>
							   	<input type="file" accept="image/x-png,image/jpeg" onchange="change_img(this)" nr ="{{$i}}"id="_{{$i}}" name="media[]">
							</div>
							    <?php $i++; ?>
						@endforeach
							    <div  id="input_{{$i}}" class="input_pic">
							    	<label for="_{{$i}}">
							       		<img src="{{url('/')}}/img/camera_green.svg" alt="" id="prev_{{$i}}" onclick="">
							      	</label>
							      	<input type="file" accept="image/x-png,image/jpeg" onchange="show_img(this); add_input(this)" id="_{{$i}}" name="media[]">

							    </div>
					</div>
					<input type="hidden" id="changed_input"  name="changed">
        			<input type="hidden" name="remove" id="remove_array">
				</div>
				

				
				<?php 
					$prices = json_decode($post->prices, true);
					$haveWekend = count($prices['weekend'])>0 ? true : false;

				 ?>
				<div id="price_range" class="marginV1">
					<div id="priceError"></div>

					<div class="price_create flex" id="defaultPriceSelecet">
						<div class="input">
							<label>time scale</label>
							<select id="defaultTimes" >
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
							<input type="number" id="defaultAmount">
						</div>
						<div class="input">
							<label>price EUR</label>
							<input id="defaultPrice"  type="number"  onblur="price(this)" step="0.01">
						</div>
						
						<button type="button" onclick="PricesAdd('default',{{$post->prices}})" class="button_add"></button>

					</div>
					<div>
						<label for="split">diferent prices in weekends</label>
						<input type="checkbox" <?php if($haveWekend){echo "checked";} ?> id="split" onchange="splitTable(this)" name="split">
					</div>
					<div class="price_create flex" id="weekendPriceSelect" >
						<div class="input">
							<label>time scale</label>
							<select id="weekendTimes">

								]
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
						<button type="button" onclick="PricesAdd('weekend',{{$post->prices}})" class="button_add"> </button>
					</div>
					<input type="hidden" id="Prices" name="prices" value="{{$post->prices}}">
					
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
								@foreach($prices['default'] as $price)
									<tr>
										<td>{{$price['time']}}</td>
										<td>{{$price['amount']}}</td>
										<td>{{$price['price']}}</td>
										<td>
											<button type="button" class="button_remove" onclick="PricesRemove(this,'default')"></button>
										</td>
									</tr>
								@endforeach
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
								@if(isset($prices['weekend']) && ($prices['weekend']!=''||$prices['weekend']!=null))
									@foreach($prices['weekend'] as $price)
										<tr>
											<td>{{$price['time']}}</td>
											<td>{{$price['amount']}}</td>
											<td>{{$price['price']}}</td>
											<td><button type="button" class="button_remove" onclick="PricesRemove(this,'weekend')"></button></td>
										</tr>
									@endforeach
								@endif
							</tbody>
							
								
						</table>
					</div>
				</div>



				<input id="lat" type="hidden" name="lat">
				<input id="lng" type="hidden" name="lng">
				<!-- <input type="submit" name="submit"> -->

				

			</div>
		</form>
	</div>

	<div class="col-md-6">		
		<div id="posError"></div>
		<div id="mappp" style="width: 100%; height: 400px"></div>
	</div>
	<div class="margin_v2 tc">
		<button type="submit" class="submit button green" id="submit" onclick="document.getElementById('form').submit()" name="submit">Save</button>
		<div class="marginV5">
			<a class="button1" href="{{url('/posts/'.$post->id)}}">cancel</a>	
		</div>
	</div>

</div>



					    
					   



@endsection

@section('scripts_top')
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="{{url('/css/create.css')}}">

@endsection

@section('scripts_bottom')
						<script type="text/javascript" src="{{url('/')}}/js/priceselect.js"></script>
						<script type="text/javascript">
							splitTable(document.getElementById('split')) //for weekend table to show up if have data
						</script>
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
							}
							 getLocation()
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
					      	console.log(current_loc)
					        var pos = { lat:{{$post->lat}},lng:{{$post->lng}} }
					        map = new google.maps.Map(document.getElementById('mappp'), {
					          center: pos,
					          zoom: 13
					        });

							console.log(map)

					        infowindow = new google.maps.InfoWindow({
					          content: document.getElementById('form')
					        });

					        messagewindow = new google.maps.InfoWindow({
					          content: document.getElementById('message')
					        });

					       marker = new google.maps.Marker({
					            position: pos,
					            map: map
					        });

					        google.maps.event.addListener(map, 'click', function(event) {
					          // marker = new google.maps.Marker({
					          //   position: event.latLng,
					          //   map: map
					          // });

					        marker.setPosition(event.latLng)
					        console.log(event.latLng.toJSON())

							document.getElementById('lat').value = event.latLng.toJSON().lat
					        document.getElementById('lng').value = event.latLng.toJSON().lng





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
					    <script async defer
					    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXhlt4YHvLGX-6FKwOhDzBrK8mHXdWoCo&callback=initMap">
					    </script>

					    <script type="text/javascript">
					    	let input_now = {{$i}};
        let changed = [];
        // for (var i = 0; i < input_now; i++) {
        // 	changed[i] 
        // }
        function show_img(that){
        	img = document.getElementById('prev'+that.id);
            img.src = URL.createObjectURL(that.files[0]);
        }


        function change_img(that){ //DISPALYS UPLOADED IMAGE
        	console.log(changed)
            img = document.getElementById('prev'+that.id);
            img.src = URL.createObjectURL(that.files[0]);
            ind = parseInt(that.getAttribute('nr'))
          	changed[ind] = ind
            document.getElementById('changed_input').value = JSON.stringify(changed)
         	console.log(changed+" "+ind)
        }



        function add_input (that=0) { //ADDS INPUT

            show_img(that); //DISPALYS NEW IMG

            input_now++;

            console.log(that);


            that.setAttribute('onchange','show_img(this)');// INITALY ADDS add_input, GETS CHANGE TO show_img AFTER FIRST IMG SELECT

            // CRTEATES INPOUT CONTEN
            input = document.createElement('input');
            input.type = 'file';
            input.name = 'media[]';
            input.setAttribute('onchange','add_input(this)');
            input.setAttribute('accept','image/x-png,image/jpeg');
            input.id ='_'+input_now;




            remove_button = document.createElement('div');
            remove_button.classList.add('button_remove');
            remove_button.id = 'remove_'+input_now;
            remove_button.setAttribute('remove',that.id);
            remove_button.setAttribute('onclick','remove_input(this)');
            that.parentNode.appendChild(remove_button);

            prev_img = document.createElement('img');
            prev_img.id = 'prev_'+input_now;
            prev_img.src = '{{url('/')}}/img/camera_green.svg';

            label = document.createElement('label');
            label.setAttribute('for','_'+input_now);
            label.appendChild(prev_img);

            input_wrap=document.createElement('div');
            input_wrap.classList.add('input_pic');
            input_wrap.id = 'input_'+input_now;
            input_wrap.appendChild(label);
            input_wrap.appendChild(input);

            console.log(input_wrap)

            document.getElementById('file_inputs').appendChild(input_wrap)

        }
        let removed = []
       	function add_to_removed(i){
       		removed.push(i)
       		document.getElementById("remove_array").value = JSON.stringify(removed)
       		console.log(document.getElementById("remove_array").value)
       		// if (changed.indexOf(i)) {
       		// 	changed.splice(i,1)
       		// 	console.log(changed)
       		// }
        }
        function remove_input(that){ //REMOVES INPUT
          
           let remove = that.getAttribute('remove')
           add_to_removed(parseInt(remove))
           let input_wrap = document.getElementById('_'+remove).parentNode;
           input_wrap.parentNode.removeChild(input_wrap);
           
        }
        // //SETS UP FIRST INPUT
        // first = document.getElementById('_{{$i}}');
        // first.setAttribute('onchange','add_input(this)');
        // first.setAttribute('remove','{{$i}}');getAttribute
		</script>
		<script type="text/javascript">
					    	$(function(){
					    		$("#form").validate({
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
					    		console.log($('#form').valid())
					    		if($('#form').valid()){
					    			document.getElementById('form').submit()
					    			// $('#post_add').submit()
					    		}
					    	}
					    </script>
@endsection
