var getLocation = function() {
  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(showPosition,showPosition);
	} else { 
	    x.innerHTML = "Geolocation is not supported by this browser.";
      showPosition()
	}
  return true;
}

function showPosition(position=null) {
  console.log(position)
  placeLoc = false
  
  placeLocInput = document.getElementById('placeLoc')

  locLat = document.getElementById('lat')
  locLng = document.getElementById('lng')

  if (locLat!=null&&locLng!=null) {
    if ((locLat.value!=null&&locLat.value!='')&&(locLng.value!=null&&locLng.value!='')) {
      placeLoc = {lat: parseInt(locLat.value), lng: parseInt(locLng.value)}
    }
  }

  //centerInput = document.getElementById('center') 
      // x.innerHTML = "Latitude: " + position.coords.latitude + 
      // "<br>Longitude: " + position.coords.longitude;

  if (!placeLoc) {

    if (position!=null&&(!('code' in position)&&!('message' in position))) {
      current_loc = {lat:position.coords.latitude,lng:position.coords.longitude}  
    }else{
      current_loc = {lat: 56.950891, lng: 24.117868}; 
    }

  }else{
    current_loc = placeLoc
  }
	
	if (document.getElementById('lat')!=null&&document.getElementById('lng')!=null) {
		document.getElementById('lat').value = current_loc.lat
		document.getElementById('lng').value = current_loc.lng
	}

	console.log(current_loc)
  if (document.getElementById('mappp')) {
	 initMap(current_loc)
  }
	if(DispalyMapInPage){
	initDisplayMap(current_loc)
	}
}

var map;
var marker;
var infowindow;
var messagewindow;

function initMap(position) {

   // var california = {lat: 37.4419, lng: -122.1419};
    current_loc= position
    //current_loc?1:current_loc=california
    // console.log(current_loc)

    map = new google.maps.Map(document.getElementById('mappp'), {
      	center: current_loc,
      	zoom: 13
    });

	// console.log(map)
    //    	infowindow = new google.maps.InfoWindow({
    //     content: document.getElementById('form')
    // });
    
    //     messagewindow = new google.maps.InfoWindow({
    //     content: document.getElementById('message')
    // });
    
    //var marker = false
    marker = new google.maps.Marker({
      position: position,
        map: map
      });
    google.maps.event.addListener(map, 'click', function(event) {

        marker = marker?marker:new google.maps.Marker({position: event.latLng,map: map});

        marker.setPosition(event.latLng)
        // document.getElementById('loc').value = JSON.stringify( event.latLng.toJSON())
        document.getElementById('lat').value = event.latLng.toJSON().lat
        document.getElementById('lng').value = event.latLng.toJSON().lng
        // console.log(document.getElementById('lat').value ,event.latLng.toJSON().lng)   
    })
 
    // console.log(document.getElementById('mappp').innerHTML)
    
    function mapreload(){
     	if (document.getElementById('mappp').innerHTML.length<500) {

     		// console.log('map not loanched')
     		initMap()
     		setTimeout(function(){
	      		mapreload()
	    	},500)
     	}else{
       // send_search_request('map')
        // console.log('map Lonched')
      }
    }
    
    setTimeout(function(){
      // mapreload()
    },500)
 
}

function initDisplayMap(position){
	dispalyDiv = document.getElementById('DispalyMap')
	DispalyMap = new google.maps.Map(dispalyDiv, {
      	center: current_loc,
      	zoom: 9
    });
  //send_search_request('new')



}