
<div class="gallery_wrap light_box">
 		<div class="gallery_content">
 		<?php $m = 0;
 		foreach($media as $display){
 			$displayed = $m == 0 ? 'displayed':''; 
 			?>
 			<div class="display_wrap {{$displayed}}">
 				<div class="display" style="background-image:url({{url('/')}}/images/{{$display}})">
 				</div>
 			</div> <?php
 		$m++;}?>

 	</div>
  	<div class="gallery_controlls sb flex" max="{{$m}}">
  		<div class="prev controller" onclick="move_dispaly(-1,this)"></div>
  		<div class="now flex"><span class="gal_now">1</span> / <span class="total">{{$m}}</span></div>
 		<div class="next controller" onclick="move_dispaly(1,this)"></div>
 	</div>
</div>