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

function showSublist(el){
    var sublist = el.getElementByTagName ("UL")[0];
    //get the child that is the ul
}

/*function sublist(){
    $('ul li.dropdown > a').click(function(event){
        $(this).parent().find('ul').slideToggle('slow');
    });
        $('a.on').click(function(){
        $('a.on').removeClass("active");
        $(this).addClass("active");
    });
}*/