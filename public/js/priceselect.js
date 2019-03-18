
let pricesList = {default:[],weekend:[]}

PricesAdd = function(split,oldList={default:[],weekend:[]}){
	//console.log(oldList)
	pricesInput = document.getElementById('Prices')
	//console.log(pricesInput.value)
	
	if (pricesInput!=null) {
			//console.log(pricesInput.value)
			//console.log(pricesInput.value.length)
		if (pricesInput.value!='' && pricesInput.value!=null && pricesInput.value.length>0) {
			oldList = JSON.parse(pricesInput.value)
		}
	}
	//console.log(oldList)

	pricesList = oldList
	let time = document.getElementById(split+'Times').value	
	let amount = parseFloat(document.getElementById(split+'Amount').value) 
	let price = parseFloat(document.getElementById(split+'Price').value)

	// console.log(time+"/"+amount+"/"+price)
	if (!empty(time)&&!empty(amount)&&!empty(price)) {

		let button = '<button type="button" class="button_remove" onclick="PricesRemove(this,\''+split+'\')"></button>' 
		//let html = '<td>'+time+'</td>'+'<td>'+price+'</td>'+'<td>'+button+'</td>';

		let row = {time:time,amount:amount,price:price}
		//console.log(row)
		if (pricesList[split].length>0) {
				i = 0

			while(pricesList[split][i].price<row.price){
				// console.log(i,pricesList[split][i])
				if(i<pricesList[split].length){
					i++;
				}
				if (pricesList[split].length === i) {break;}5
			}

			//console.log(i + '<-- i')
			pricesList[split].splice(i,0,row)

		}else{
			pricesList[split].push(row)
		}

		//console.log(pricesList)
		let html = ''
		for (var i = 0; i < pricesList[split].length; i++) {
			let r = 0
		//	html+='<tr r="'+r+'"><td>'+pricesList[split][i].amount+' '+pricesList[split][i].time+'<td/><div>aaa</div><td>'+pricesList[split][i].price+'</td><td>'+button+'</td>'+'</tr>'
		//	html+='<tr r="'+r+'"><td>'+pricesList[split][i].amount+'</td><td> '+pricesList[split][i].time+'<td/><td>'+pricesList[split][i].price+'</td><td>'+button+'</td>'+'</tr>'
			html+='<tr r="'+r+'"><td>'+pricesList[split][i].amount+' '+pricesList[split][i].time+'</td><td>'+pricesList[split][i].price+'</td><td>'+button+'</td></tr>'
			r++	
		}
		// console.log(html)
		setInputs()

		//console.log(html)
		document.getElementById(split+'PricesData').innerHTML = html
	}
}

function setInputs(){
	//console.log(pricesList)
	document.getElementById('Prices').value = JSON.stringify(pricesList)
	//document.getElementById('weekendPricres').value = JSON.stringify(pricesList['weekend'])

}
PricesRemove =function(that,split){
	let tr = that.parentNode.parentNode
	let r = parseInt(tr.getAttribute('r'))

	console.log(tr.getAttribute('r'))
	pricesList[split].splice(r,1)
	console.log(pricesList)
	setInputs()
	tr.parentNode.removeChild(tr)
}

function splitTable(that){
	document.getElementById('')
	if (that.checked) {
		//document.getElementById('weekendTable')

		$('#weekendTable').css('display','block')
		$('#weekendPriceSelect').css({'display':'flex','display':'-webkit-flex'})
	}else{
		$('#weekendTable').css('display','none')
		$('#weekendPriceSelect').css('display','none')

	}
}

