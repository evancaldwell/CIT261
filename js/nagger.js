//Main Functions For Nag App

//Initialize the ability to talk to the server
var server = new talkToServer('/backend/server.php')

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
	var newItemBtn = $('add-item-btn');
	var newItemView = $('new-item');
	newItemBtn.newItemView = newItemView;

	var wordcloudBtn = $('wordcloud-btn');
	var wordcloudView = $('wordcloud');
	wordcloudBtn.wordcloudView = wordcloudView;
}

//onload
function setup1() {
	var container = $('container')
	container.style.height = window.innerHeight
	var viewWidth = container.offsetWidth
	console.log(window.innerHeight)
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
	div.style.width = viewWidth - 45 + 'px'
	div.style.height = viewHeight - 90 + 'px'
	div.style.left = '45px'
}

function hideWordcloudView(el) {
	var viewWidth = $('container').offsetWidth
	var viewHeight = $('container').offsetHeight
	var div = $('wordcloud')
	div.style.left = '100%'
}

function showNewItemView(el) {
	var viewWidth = $('container').offsetWidth
	var viewHeight = $('container').offsetHeight
	var div = $('new-item')
	div.style.width = viewWidth - 45 + 'px'
	div.style.height = viewHeight - 90 + 'px'
	div.style.left = '45px'
}

function hideNewItemView(el) {
	var viewWidth = $('container').offsetWidth
	var viewHeight = $('container').offsetHeight
	var div = $('new-item')
	div.style.left = '100%'
}





// =========== Playing with the word cloud ================
function buildWordArray (wordList) {
	wordList = ['family', 'family', 'family', 'work', 'family', 'work', 'school', 'work', 
				'family', 'school', 'CIT', 'shopping', 'eat', 'shopping', 'cake', 'kids', 
				'PTA', 'kids', 'groceries', 'groceries', 'kids'];
	var objArr = [], prev, j = 0;

	wordList = wordList.sort();

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
		objArr[key].size = objArr[key].size * objArr[key].count // ideally size should be dependent on viewport
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
};