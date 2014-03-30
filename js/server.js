//JavaScript to talk to Backend

//PLEASE EXERCISE CAUTION IF YOU NEED TO EDIT THIS FUNCTION
function talkToServer(url) {
	var self = this
	this.sendData = function (requestType, cmd, data, callBackFunction) {
		var request = new XMLHttpRequest()
		request.open(requestType, url, true)
		var jsonString = JSON.stringify(data)
		alert(jsonString)
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				var responseString = request.responseText
				if (responseString) {
					var responseData = JSON.parse(responseString)
				}
				callBackFunction(responseData)
			}
		}
		if (requestType == 'POST') {
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			request.send('cmd='+cmd+'&data='+jsonString)
		} else {
			request.send()
		}
	}
}