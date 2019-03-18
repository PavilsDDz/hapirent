class Popup{

	constructor(text='', type='', options=[]){
		
		this.type = type
		this.text = text
		this.options = options

		console.log(options)


		// creates Popup html
		let buttons = ''
		for (var i = 0; i < this.options.length; i++) {
			buttons += '<div class="button '+this.options[i].action+'"><a>'+this.options[i].name+'</a></div>'
			console.log(buttons)
		}

		this.html = `<div id="popup_wrap" class="flex">
						<div id="popup_close_wrap">	</div>
						<div id="popup">
							<div id="popup_close">x</div>
							<div id="popup_content">
								<div class="text"><p>`+text+`</p></div>
								<div class="actions">`+buttons+`</div>
							</div>
						</div>
					</div>`

		document.getElementsByTagName('body')[0].innerHTML += this.html
		console.log(document.getElementsByTagName('body'))

		// Asigns functions to buttons
		for (var i = 0; i < this.options.length; i++) {
			let button = document.querySelector('#popup .button.'+this.options[i].action)
			console.log(button)
			switch(this.options[i].action){
				case 'cancel':
					console.log('cancel')
					button.onclick = this.close
					break
				default:
					console.log(this.options)
					if (typeof this.options[i].function == 'function') {
						let fnc = this.options[i].function
						let close = this.close
						button.onclick = function(){
							// console.log(this.options)
							close()
							fnc()
						}
					}
					break
			}
		}
		document.getElementById('popup_close').onclick= this.close;
		console.log(document.getElementById('popup_close'))
	}

	close(){
		console.log('close')
		let popup_wrap = document.getElementById('popup_wrap') 
		popup_wrap.parentNode.removeChild(popup_wrap)
	}
}