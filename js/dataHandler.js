//Data Handler Functions For Nag App

//Initialize the ability to talk to the server
var server = new talkToServer('/backend/nag.php')

function signUserIn() {
	var username = 'Sarah'
	var password = 'testing'
	server.sendData('POST', 'signInUser', [{"username" : username , "password" : password}], logIt)
}

function getUserList() {
	server.sendData('POST', 'getUserList', '', logIt)
}

function getSubitems(item_id) {
	server.sendData('POST', 'getSubItems', [{"item_id" : item_id}], logIt)
}

function getTagCloud() {
	server.sendData('POST', 'getTagCloud', '', logIt)
}

function logIt(theDataWeGotBack) {
	console.log(theDataWeGotBack)
}

function showCookie() {
	console.log(readCookie('NAGSESSION'))
}

function readCookie(name) {
    var nameEQ = name + "="
    var ca = document.cookie.split(';')
    for(var i=0;i < ca.length;i++) {
        var c = ca[i]
        while (c.charAt(0)==' ') c = c.substring(1,c.length)
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length)
    }
    return null
}