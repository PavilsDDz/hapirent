<?php   $sdf = isset($search); //search defined
        if($sdf){if(isset($search['placeLoc'])){ $placeLoc = json_decode($search['placeLoc'],true);}}
?>
<form class="form" id="search_form">
    <div class="input flex">
        <div class="label">
            type
        </div>    
        <select type="text" id="input_type" name="type">
            <option value=""></option>  
            <option value="sand" <?php if($sdf){if(isset($search['type']) && $search['type']=="sand"){echo 'selected';}} ?>>{{trans('index.ground')}}</option>  
            <option value="snow" <?php if($sdf){if(isset($search['type']) && $search['type']=="snow"){echo 'selected';}} ?>>{{trans('index.snow')}}</option>    
            <option value="water" <?php if($sdf){if(isset($search['type']) && $search['type']=="water"){echo 'selected';}} ?>>{{trans('index.water')}}</option>   
            <option value="air" <?php if($sdf){if(isset($search['type']) && $search['type']=="air"){echo 'selected';}} ?>>{{trans('index.air')}}</option> 
        </select>
    </div>
    <input type="hidden" name="lng" id="lng" value="<?php if($sdf){if(isset($search['placeLoc'])){echo $placeLoc['lng'];}} ?>">
    <input type="hidden" name="lat" id="lat" value="<?php if($sdf){if(isset($search['placeLoc'])){echo $placeLoc['lat'];}} ?>">
    <div class="input flex">
        <div class="label">
            radius
        </div>
        <input type="number" name="radius" value="" id="radius">
        
    </div>


</form>
    <div class="label">
        pick a place for search
    </div>
    <div id="mappp">
        
    </div>
    <div class="flex cc input">
        <button id="search_submit" type="button" class="button green">Search</button>
    </div>

<script type="text/javascript">
      
            var postMarkers = [];

            var clusterStyles = [
      {
        textColor: 'rgb(0,0,100)',
        url: '{{url('/')}}/img/markercluster1.png',
        height: 40,
        width: 40,
        textSize: 20,
      },
     {
        textColor: 'rgb(0,0,100)',
        url: '{{url('/')}}/img/markercluster1.png',
        height: 40,
        width: 40,
        textSize: 20,
      },
     {
        textColor: 'rgb(0,0,100)',
        url: '{{url('/')}}/img/markercluster1.png',
        height: 40,
        width: 40,
        textSize: 20,
      }
    ];
            
    $(document).ready(function() {

        
        document_height = $('#posts_conatainer').height()
        viewport_height = $('#posts_wrap').height()
        callable = true 
        last_page = 1;
        page = 0
        var markerPos = []
        var markerContents = []
        var markerCluster = false;


            document.getElementById('search_submit').addEventListener('click', function(){ 

                inputs.type = document.getElementById('input_type').value
                inputs.lat = document.getElementById('lat').value
                inputs.lng = document.getElementById('lng').value
                inputs.radius = document.getElementById('radius').value
                inputs.page = 1
                inputs.perPage = perPage
               // inputs.search = search

                postRequest(inputs);

                let rad = document.getElementById('radius').value; 
                if(rad==null || rad == ''){ document.getElementById('radius').value=50}
            });


        function scoll_control(){

        }
       $('#posts_wrap').scroll(function(){
            scroll_top= $('#posts_wrap').scrollTop()
           //console.log(scroll_top +'/'+(document_height- viewport_height -1)+'/'+callable+'/'+page+'/'+last_page)
        
           if (scroll_top>=(document_height- viewport_height -1)&&callable&&page<last_page) {
                page ++
                // send_search_request('more')
           }
        })


        $(window).resize(function(){
            document_height = $('#posts_conatainer').height()
            viewport_height = $('#posts_wrap').height()
        })

    })
    pageLoadedFunctions.push(postRequest)
</script>