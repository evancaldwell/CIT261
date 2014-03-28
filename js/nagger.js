//Main Functions For Nag App

//Initialize the ability to talk to the server
var server = new talkToServer('/backend/server.php')

//General Functions for Nag App

//Use the Following Funtion for all document.getElementById calls
//Example: $('exampleID') will return the actual element for that ID
function $(el) {
	return document.getElementById(el)
}

function iClickedIt() {
	console.log(tryIt)
	server.sendData('POST', 'Hello', {'someReallyImportantNumber': 23898765434567}, allDone)
}

function allDone(theDataWeGotBack) {
	console.log(theDataWeGotBack)
}


//A function for setting up the page oncreate
function setup() {
	var loginCookie = readCookie('NAGSESSION')
	showCookie()
	// var loginCookie = false
	if (loginCookie == false || loginCookie == null) {
		showLoginView()
	}
	var newItemBtn = $('add-item-btn');
	var newItemView = $('new-item');
	newItemBtn.newItemView = newItemView;

	var wordcloudBtn = $('wordcloud-btn');
	var wordcloudView = $('wordcloud');
	wordcloudBtn.wordcloudView = wordcloudView;
}

//onload
function setup1() {
	// var container = $('container')
	// container.style.height = window.innerHeight + 'px'
	// container.style.width = window.innerWidth + 'px'
	// var viewWidth = container.offsetWidth
	// console.log(window.innerWidth)
	// var overlays = document.getElementsByClassName('overlay')
	// for (i=0; i<overlays.length; ++i) {
	// 	overlays[i].style.width = viewWidth - 45
	// }
}

// ============ page animation functions ============
function showWordcloudView(el) {
	var viewWidth = $('container').offsetWidth
	var viewHeight = $('container').offsetHeight
	var div = $('wordcloud')
	var newItemView = $('new-item')
	var login = $('login')
	var signup = $('signup')
	showTransparency()
	div.style.left = '45px'
	div.style.height = viewHeight - 90 + 'px'
	div.style.width = viewWidth - 45 + 'px'
	hideView(newItemView, false)
	hideView(login, false)
}

function showNewItemView(el) {
	var viewWidth = $('container').offsetWidth
	var viewHeight = $('container').offsetHeight
	var div = $('new-item')
	var wordcloud = $('wordcloud')
	var login = $('login')
	var signup = $('signup')
	showTransparency()
	div.style.left = '45px'
	div.style.height = viewHeight - 90 + 'px'
	div.style.width = viewWidth - 45 + 'px'
	hideView(wordcloud, false)
	hideView(login, false)
}

function showLoginView() {
	var viewWidth = $('container').offsetWidth
	var viewHeight = $('container').offsetHeight
	var div = $('auth')
	var wordcloud = $('wordcloud')
	var newItemView = $('new-item')
	var signup = $('signup')
	div.style.left = '0px'
	div.style.height = viewHeight + 'px'
	div.style.width = viewWidth + 'px'
	hideView(wordcloud, false)
	hideView(newItemView, false)
}

function hideView(el, trans) {
	if (el == "all") {
		$('new-item').style.left = '100%'
		$('wordcloud').style.left = '100%'
	} else {
		el.style.left = '100%'
	}
	if (trans) {
		hideTransparency()
	}
}

function showRegisterView(el) {
	var pass2Input = $('pass2')
	var btn = $('login-btn')
	pass2Input.style.height = 'auto'
	pass2Input.style.border = '1px solid #587C7C'
	pass2Input.style.padding = '2px'
	btn.innerHTML = 'Register'
	el.innerHTML = 'Back to login'
	el.onclick = function() {backToLoginView(this)}
}

function backToLoginView(el) {
	var pass2Input = $('pass2')
	var btn = $('login-btn')
	pass2Input.style.height = '0'
	pass2Input.style.border = '0'
	pass2Input.style.padding = '0'
	btn.innerHTML = 'Login'
	el.innerHTML = "Don't have an account? Register here."
	el.onclick = function() {showRegisterView(this)}
}


function showTransparency() {  // TODO: this peice is not working
	var div = $('transparency')
	// div.style.background = 'rgba(100,100,100,0.75)'
	div.style.left = '0px'
}

function hideTransparency() {  // TODO: this peice is not working
	var div = $('transparency')
	div.style.left = '100%'
}

function showSublist(el) {  // TODO: having a problem with the tooltip if it has a sublist
	var sublist = el.parentNode.getElementsByTagName("UL")[0]
	var dropIcon = el.getElementsByTagName("SPAN")[0]
	sublist.style.height = '60px'  // TODO: this needs to be dynamic
	dropIcon.style.transform = 'rotate(90deg)'
	el.onclick = function() {hideSublist(this)}
}

function hideSublist(el) {
	var sublist = el.parentNode.getElementsByTagName("UL")[0]
	var dropIcon = el.getElementsByTagName("SPAN")[0]
	sublist.style.height = '0px'
	dropIcon.style.transform = 'rotate(0deg)'
	el.onclick = function() {showSublist(this)}
}

function showTooltip(el) {
	var div = el.children[1]
	//div.style.overflow = 'visible'
	div.style.height = '60px'
	el.onclick = function() {hideTooltip(this)}
}

function hideTooltip(el) {
	var div = el.children[1]
	//div.style.overflow = 'hidden'
	div.style.height = '0px'
	el.onclick = function() {showTooltip(this)}
}


// =========== Playing with the word cloud ================
function buildWordArray (wordList) {
	wordList = getTagCloud();

	wordList = ['family', 'family', 'family', 'work', 'family', 'work', 'school', 'work', 
				'family', 'school', 'CIT', 'shopping', 'eat', 'shopping', 'cake', 'kids', 
				'PTA', 'kids', 'groceries', 'groceries', 'kids']

	var objArr = [], prev, j = 0

	wordList = wordList.sort()

	for (var i=0; i<wordList.length; i++) {
		if (wordList[i] !== prev) {
			objArr.push({tag: wordList[i], count: 1, size: 100})
			j++
		} else {
			objArr[j-1].count ++
		}
		prev = wordList[i]
	}

	for (key in objArr) {
		objArr[key].size = objArr[key].size * objArr[key].count // TODO: ideally size should be dependent on viewport
	}

	return objArr
}

function buildWordCloud(el, callback) {
	var objects = buildWordArray() // TODO: need to pass in the actual tags
	var div = $("wordcloud-inner")
	var html = ""
	for (key in objects) {
		html += '<div id="cloud-item' + objects[key].tag + '" class="" style="font-size:' + objects[key].size + '%">'
		html += objects[key].tag + '</div>'
	}
	div.innerHTML = html

	callback();
}



// =========== General Utility Functions ================
Array.prototype.count = function(value) {
  var counter = 0;
  for(var i=0;i<this.length;i++) {
    if (this[i] === value) counter++;
  }
  return counter;
}
