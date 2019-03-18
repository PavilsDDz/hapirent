@push('scripts_top')

<link rel="stylesheet" type="text/css" href="{{asset('css/posts.css')}}">
<script type="text/javascript">
	var DispalyMapInPage = true
	var DispalyMap
	var inputs = {view:'list'};
</script>		
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<style type="text/css">
/*	html{
		overflow: hidden;
	}*/
	<style type="">	
	html{
		/*overflow: hidden;*/
		height: 100%;
		position: relative;
	}
	#app {
		overflow: hidden;
		/*height: 100%;*/
		position: relative;
	}
</style>

@endpush
<div id="posts" class="content with_side">
	<div id="posts_display_controlls" class="light_box">
		
			<div class="flex jc">
				<div class="icon_button map_icon" id='map_button' onclick="view_toggle(this,'map')">
				</div>
				<div class="icon_button list_icon" id='list_button' onclick="view_toggle(this,'list')">
				</div>

				<!-- <button  class="button1" >view on map</button> -->
			</div>
		
	</div>
	<div id="posts_display">
		<div class="" id="DispalyMapWrap">
			<div id="DispalyMap" style=""></div>
		</div>
		<div id="pageination"></div>
		<div id="posts_conatainer">

		</div>
		
	</div>
</div>
@push('scripts_bottom')
	<script src="{{url('/js/map.js')}}"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHuLlB9rGRw-LAVatvmmugZrk8JJ9fz3E&callback=getLocation"></script>
	<script type="text/javascript">

		active = document.getElementById('list_button')
		active.classList.add('active')
		
	</script>
@endpush