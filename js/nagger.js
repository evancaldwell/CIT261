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



// ============ page animation functions ============
function showOverlay(el) {
	var div = $("new-item");
	div.className = div.className + " show-overlay";
}

function hideOverlay(el, callback) {
	var div = $("new-item");
	div.className = div.className + " hide-overlay";

	setTimeout(function () {div.className = "overlay"}, 300);
}

function collapse(el) {
	el.className = "overlay";
}



// =========== Playing with the word cloud ================
function buildWordArray (wordList) {
	wordList = ['family', 'family', 'family', 'work', 'family', 'work', 'school', 'work', 'school', 'CIT', 'shopping', 'eat', 'shopping'];
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

function buildWordCloud(el) {
	var objects = buildWordArray() // TODO: need to pass in the actual tags
	var div = $("wordcloud-inner")
	var html = ""
	for (key in objects) {
		html += '<div id="cloud-item' + objects[key].tag + '" class="" style="font-size:' + objects[key].size + '%">'
		html += objects[key].tag + '</div>'
	}
	div.innerHTML = html
}



// =========== General Utility Functions ================
Array.prototype.count = function(value) {
  var counter = 0;
  for(var i=0;i<this.length;i++) {
    if (this[i] === value) counter++;
  }
  return counter;
};