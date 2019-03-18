
<div class="gallery_wrap">
	
   <div id="gallery_img" class="image flex">
   		<img id="dispaly_img" src="{{url('/')}}/img/icons/loading.gif">
   </div>
    <div class="controls" id="gallery_controlls">
    	<div id='next_img' onclick="change_img(1)" class="prev gal_controll"></div>
    	<div id='prev_img' onclick="change_img(-1)" class="next gal_controll"></div>
    </div>
    <div class="gallery_info">
    	<p id="img_description"></p>	
    </div>
</div>
<script type="text/javascript">

	let media = JSON.parse('{!!$gal->media!!}')
	let media_desc = JSON.parse('{!!$gal->media_description!!}')
	let all = media.length
	let now = 0


	let newImg = new Image;
	newImg.onload = function() {
	    _img.src = this.src;
	}
	let _img = document.getElementById('dispaly_img');

//IMG CHANGE 

	function set_img(img){
		_img.src = '{{url("/")}}/img/icons/loading.gif'
		newImg.onload = function() {
		    _img.src = this.src;
		}
		newImg.src = "{{url('/')}}/uploads/imgs/"+media[img];
	} 
	set_img(0);
	function change_img(dir){

		now += dir
		if (now>all-1) {
			now = 0
		}
		if(now<0){
			now = all-1 
		} 
		newImg.src = "{{url('/')}}/uploads/imgs/"+media[now]

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
	


</script>