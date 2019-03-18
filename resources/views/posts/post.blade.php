<?php 
    if (isset($post)) {
        $media = json_decode($post->media);
        $cover = empty($media[0])?'no-img.svg':$media[0];
        $prices = json_decode($post->prices);
    }elseif(isset($jsTemlapate)){
        $post = new stdClass();
        $post->id = '${data.posts.data[i]["id"]}';
        $post->name = '${data.posts.data[i]["name"]}';
        $post->description = '${data.posts.data[i]["description"]}';
        $cover = '${cover_img}';
        $prices = json_decode('{"default":[{"price":"${prices.default[0].price}","amount":"${prices.default[0].amount}","time":"${prices.default[0].time}"}]}',false);
        
    };
 ?>
<?php  if(isset($jsTemlapate)){echo '`';}?>
<div class="marginV5 multiPost">
    <div class="flex light_box">
            <div class="thumb" style="background-image: url({{url('/')}}/images/thumbs/{!!$cover!!});">
                <a href="{!!url('/')!!}/posts/{!!$post->id!!}">
                    <div class="fill"></div>
                </a>  
            </div> 
        <div class="text">
            <a href="{!!url('/')!!}/posts/{!!$post->id!!}"><h3>{!!$post->name!!}</h3></a>
            <p>{!!$post->description!!}</p>
            
            <span>prices starting at <i>{!!$prices->default[0]->price!!} euro / {!!$prices->default[0]->amount!!} {!!$prices->default[0]->time!!}</i></span>   
            <div class="flex marginV5 options">
            	<a href="{!!url('/')!!}/posts/{!!$post->id!!}" class="button3">view</a>
                @if(isset($myPosts)&&$myPosts)
            	<a class="button3" href="{!!url('/')!!}/posts/{!!$post->id!!}/edit">edit</a>
                @endif
            </div>
            
        </div>
    </div>
</div>
<?php  if(isset($jsTemlapate)){echo '`';}?>