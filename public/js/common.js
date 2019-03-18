//colecta all functions to execute when page has loaded 
var pageLoadedFunctions = [];


function pageLoaded(fnc){//adds 
	pageLoadedFunctions.push(fnc)
	// console.log(pageLoadedFunctions)
}

$(function(){
	for (var i = 0; i < pageLoadedFunctions.length; i++) {
		pageLoadedFunctions[i]()
	}
})

/*------
HELPER FUNCTIONS
-------*/

function dateInput(that){
	$(that).datepicker()
}

function empty(value){
	value+=''
	if (value.length<1 || value.length=='undefined' || (value=='NaN'||value=='undefined'||value=='null')) {
		return true;
	}
	return false;
}

/*------
END helper functions
-------*/


function postRequest(params=[]){
	params['_token'] = document.getElementById('csrf').getAttribute('content')
	// console.log(params)

	loadingDiv = document.createElement('div')
	loadingDiv.classList.add('loading_img')
	loadingImg =  document.createElement('img')
	loadingImg.src = base_url+'/img/loading.gif'
	loadingDiv.appendChild(loadingImg)
	document.getElementById('posts_conatainer').appendChild(loadingDiv)

	$.ajax({
		type: "POST",
		url: base_url+"/quer_posts",
		data: params,
		dataType: 'JSON',
		headers: {
		    'X-CSRF-TOKEN': document.getElementById('csrf').getAttribute('content')
		},
		success: function(respons){
			console.log(respons)
			switch(inputs['view']){
				case 'list':
					makePostList(respons)
					break;
				case 'map':
					respons['posts']={data:respons.posts}
					makePostMap(respons)
					break;

				default:
					//makePostList(respons)

			}
			return true;
		},
		error: function(respons){
			// console.log(respons,'fail')
		}
	})
}

function makePostList(data){
	posts_conatainer =document.getElementById('posts_conatainer') 
	posts_conatainer.innerHTML = ''//removeChild(posts_conatainer.getElementsByClassName('loading_img')[0])
	//console.log(data)

	paginate(data)

	for (var i = 0; i < data.posts.data.length; i++) {

		let cover_img = 'no-img.svg'
        if (data.posts.data[i].media!=null) {
            cover_img = JSON.parse(data.posts.data[i].media)[0] 
        }
        let prices = JSON.parse(data.posts.data[i].prices)

        if (prices.default.length<1) { //fixes error if no prices in db
        	prices.default[0]=''
        }

		eval('template = '+data.template)
		document.getElementById('posts_conatainer').innerHTML += template 


	}
}

function makePostMap(data){
	//console.log(data)
	if(postMarkers.length>0&&inputs['view']=='map'){
      	//console.log('should clera')
      	for (var i = 0; i < postMarkers.length; i++) {
      	    postMarkers[i].setMap(null);
      	}
        postMarkers = []
    }
        markerContents = []
        markerPos=[]

	icons = {
        water:{
            icon: base_url+'/img/water.png'
        },
        air:{
            icon: base_url+'/img/air.png'
        },
        snow:{
            icon: base_url+'/img/snow.png'
        },
        ground:{
            icon: base_url+'/img/ground.png'
        }
    };

	for (var i = 0; i < data.posts.data.length; i++) {
		 markerPos[i] = new google.maps.LatLng(data.posts.data[i].lat, data.posts.data[i].lng);

	    let type

	    switch(data.posts.data[i]['type']){
	    	case 0:type ='snow'; break;
	    	case 1:type ='water'; break;
	    	case 2: type = 'ground'; break;
	    	case 3:type ='air'; break;
	    	default:type = null; break;
		}

	    var marker = new google.maps.Marker({  
	      map: DispalyMap, title: data.posts.data[i]['name'] , position: markerPos[i], icon:{url:icons[type].icon,size: new google.maps.Size(28, 28)}
	    });

	   // console.log(marker)

	    postMarkers.push(marker)

	    let cover_img = 'no-img.svg'
	    if (data.posts.data[i].media!=null) {
	        cover_img = JSON.parse(data.posts.data[i].media)[0] 
	    }
	    let prices = JSON.parse(data.posts.data[i].prices)
	    // console.log(prices)

	        var content = `<div class='map_infowindow flex column'>
	                            <a href="${base_url}/posts/${data.posts.data[i]['id']}">
	                            <h5>${data.posts.data[i]['name']}</h5>
	                            <img src='${base_url}/images/thumbs/${cover_img}'>
	                            <p>
	                                <span>${prices['default'][0]['price']+'euro / '+prices['default'][0]['amount']+prices['default'][0]['time']}</span>
	                            </p>
	                            <p>
	                                ${data.posts.data[i]['description']}
	                            </p>
	                        </div>`    
	        // console.log(content)
	    var infowindow = new google.maps.InfoWindow()
	    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
	        return function() {
	           infowindow.setContent(content);
	           infowindow.open(DispalyMap,marker);
	        };
	    })(marker,content,infowindow)); 

    	// document.getElementById('posts_conatainer').getElementsByClassName('lo')
	}

}


var view_toggle = function(that, toggle){
			//console.log(toggle)
			inputs['view'] = toggle
			postRequest(inputs)
				let map = document.getElementById('DispalyMapWrap')
				let list = document.getElementById('posts_conatainer')
				switch(toggle){
					case 'map':
						active.classList.remove('active')
						active = that
						that.classList.add('active')
						map.style.display = 'block';
						list.style.display = 'none';
					break;
					
					case 'list':
						active.classList.remove('active')
						active = that
						that.classList.add('active')
						map.style.display = 'none';
						// console.log(list)
						list.style.display = 'block';
					break;
					default: 
					break;
				
			}
		};
var pageNow = 0;
postsInView = 0;

function paginate(data){
	pageMax = data.posts.last_page
	pageNow = data.posts.current_page

	displayMidCount = pageMax>7 ? 7:pageMax
	container = document.getElementById('pageination')
	container.innerHTML=''

	displayMaxCount = pageNow + Math.min(Math.max(pageMax-pageNow, 0), 3)
	displayMinCount = pageNow + Math.min(Math.max(-pageNow,-4), 0)+1
	displayMaxCount += Math.abs(Math.min(displayMaxCount - displayMidCount,0))
	if (pageNow - pageMax > -3 && pageMax > 7) {
		displayMinCount -= 3+(pageNow - pageMax)
	}


	if (pageMax>1 && pageNow>1) {
		prev = document.createElement('div')
		prev.classList.add('prev')
		prev.classList.add('prev')
		prev.innerHTML = '<'
		prev.setAttribute('onclick','loadPostPage('+(pageNow-1)+')')
		container.appendChild(prev)
	}

	if (displayMinCount>1) {
		a = document.createElement('button')
		a.innerHTML = 1+'...'
		a.setAttribute('onclick','loadPostPage('+1+')')
		a.setAttribute('type','button')
		container.appendChild(a)
	}

	console.log(displayMinCount)
	//console.log(displayMidCount,pageNow%displayMidCount)

	for (var i = displayMinCount; i < displayMaxCount+1; i++) {
		a = document.createElement('button')
		// console.log(a)

		a.setAttribute('onclick','loadPostPage('+i+')')
		a.setAttribute('type','button')
		if (pageNow==i) {
			html = '<b>'+i+'</b>'
		}else{
			html = i
		}

		a.innerHTML=html
		container.appendChild(a)

	}

	if (displayMaxCount<pageMax) {
		a = document.createElement('button')
		a.innerHTML = '...'+pageMax
		a.setAttribute('onclick','loadPostPage('+pageMax+')')
		a.setAttribute('type','button')
		container.appendChild(a)

	}



	if (pageMax>1 && pageNow<pageMax) {
		next = document.createElement('div')
		next.classList.add('next')
		next.classList.add('next')
		next.innerHTML = '>'
		next.setAttribute('onclick','loadPostPage('+(pageNow+1)+')')
		container.appendChild(next)

	}

}
function loadPostPage(page){
	inputs['page'] = parseInt(page)
	postRequest(inputs)
}
function postListScroll(){
	postsInView = document.getElementById('posts_conatainer').getElementsByClassName('multiPost')
	postCount = postsInView.length
	// if(postRequest('add'))
}

function checkInput(that){
	console.log(that)
}

function validate(){}