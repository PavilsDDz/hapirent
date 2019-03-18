$(function(){
	// gal_cont = $('.gallery_controlls')
	// max = parseInt(gal_cont.attr('max'))
	 let clickable = true
	 move_dispaly = function(dir,that){
	 	if (clickable) {
	 		clickable = false

		 	let max = parseInt($(that).parent().attr('max'))
		 	let gal_cont = $(that).parent().siblings('.gallery_content')
		 	let disp_now = gal_cont.children('.displayed')
		 	let disp_ind = disp_now.index()
			let to = disp_ind+dir

			
		 	if (to>max-1) {
		 		to = 0
		 	}
		 	if(to<0){
		 		to = max-1
		 	}
		 		 	
		 	disp_now.animate({'opacity':0},300,function(){
		 		clickable = true;
		 	}).css({'z-index':1}).removeClass('displayed')

		 	disp_to = gal_cont.children('.display_wrap:nth-child('+(to+1)+')')

		 	disp_to.css({'z-index':2}).addClass('displayed').animate({'opacity':1},300)
			
	 	}	
	}

})