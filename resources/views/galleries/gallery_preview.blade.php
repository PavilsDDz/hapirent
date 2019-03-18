
<div id="gallery_preview" class="gallery_wrap mob_col">
	<div id="gal_description_wrap">
		<h3 id="gallery_title" class="tc">Lorem ipsum</h3>
		<p id="gallery_description">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.		
		</p>
	</div>
	<div id="gallery_img" class="image flex">
   		<img id="dispaly_img" src="{{url('/')}}/img/icons/loading.gif">
    	<div id='next_img' onclick="change_img(1)" class="prev gal_controll"></div>
    	<div id='prev_img' onclick="change_img(-1)" class="next gal_controll"></div>
   </div>
    <div class="controls" id="gallery_controlls">
    	<div class="close" id="gal_close"></div>
    </div>
    <div class="gallery_info">
    	<p id="img_description"></p>	
    </div>
</div>


	<script type="text/javascript" src="{{url('/')}}/js/hammer.js"></script>
	<script type="text/javascript">

	
	let GlPnow = 0
	let GlPall 
	let GlPnewImg = new Image()
	let GlPimgs = []
	let GlP_img
	let GlPgal
	let lng = '{{Lang::locale()}}';
	console.log(lng)


	function set_img(img){
		GlP_img.src = '{{url("/")}}/img/icons/loading.gif'
		GlPnewImg.onload = function() {
		    GlP_img.src = this.src;
		}
		GlPnewImg.src = "{{url('/')}}/uploads/imgs/"+img;
	} 
	// ;

	function change_img(dir){

		GlPnow += dir
		if (GlPnow>GlPall-1) {
			GlPnow = 0
		}
		if(GlPnow<0){
			GlPnow = GlPall-1 
		} 
		//GlPnewImg.src = "{{url('/')}}/uploads/imgs/"+imgs[GlPnow]
		console.log(GlPnow, GlPimgs[GlPnow])
		set_img(GlPimgs[GlPnow])
	}

// MOBILE SUPPORT

	let gallery_pan = new Hammer(document.getElementById('gallery_controlls'));
	gallery_pan.on('panend', function(ev) {
		
		if(ev.type="panright"){
			change_img(-1)
		}else if(ev.type="panleft"){
			change_img(1)
		}
	});
	

		function dispalyGallery(data){
			
			GlPgal = document.getElementById('gallery_preview')
			GlPgal.classList.add('flex')
			media = JSON.parse(data.media)
			GlPall = media.length
			GlPimgs = media
			GlP_img = document.getElementById('dispaly_img')
			set_img(media[0])
			console.log(media)
			document.getElementById('gallery_description').innerHTML= data['description_'+lng]
			document.getElementById('gallery_title').innerHTML= data['title_'+lng]
			document.getElementById('gal_close').onclick = function(){
				GlPgal.classList.remove('flex')
				console.log('sdsds')
			}

		}
		function getGallery(id){
			let req = new XMLHttpRequest();
	        req.open("GET", "{{url('/')}}/galleries/ajax?id="+id)
	        req.onreadystatechange = function(){
	        	if (req.readyState == 4 ) {

	        		if (req.status==200) {
	        			let data =  JSON.parse(req.response)
	        			dispalyGallery(data)
	        		}else{
	        			console.log('error')
	        		}
	        	}
	        }
	        req.send();
		}



	</script>
