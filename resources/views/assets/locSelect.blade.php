<script type="text/javascript">
	var initAutocomplete = function(){

			var input = document.getElementById('input_location');

        	var searchBox = new google.maps.places.SearchBox(input);

        	searchBox.addListener('places_changed', function() {
          	var places = searchBox.getPlaces();
          	console.log(places)
          	if (places.length == 0) {
            	return;
          	}else{
          		document.getElementById('placeLoc').value = JSON.stringify({lat:places[0].geometry.location.lat(),lng:places[0].geometry.location.lng()})
          		document.getElementById('placeDisplay').innerHTML = places[0].adr_address
          		console.log(document.getElementById('placeLoc').value)		
          	}
			
			})
		}
</script>
	<label for="input_location">{{trans('index.location')}}</label>
<div class="input">
	<input type="text" id="input_location" name="searchBox">
	<p id="placeDisplay"></p>	
	<input type="hidden" id="placeLoc" name="placeLoc">
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHuLlB9rGRw-LAVatvmmugZrk8JJ9fz3E&libraries=places&callback=initAutocomplete"
         async defer></script>