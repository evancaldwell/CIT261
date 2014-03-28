<?php
$string = '[{"name":"Shopping","rate":"5","subItems":["Cookies","Milk","Chips"]}]';
$json = json_decode($string, true);
echo '<pre>';
print_r($json);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>JSON Create</title>
<script>
function compileData() {
	var name = document.getElementById('name').value
	var rate = document.getElementById('rate').value
	var subs = document.getElementsByName('subs[]')
	
	var subItems = new Array
	
	for (var i = 0; i < subs.length; i++) {
		subItems.push(subs[i].value)
	}
	
	var data = JSON.stringify([{"name":name , "rate":rate , "subItems":subItems}])
	console.log(data)
}
</script>
</head>

<body>
<p>Item</p>
<input id="name" type="text" name="name" value="Shopping">
<p>Rate</p>
<input id="rate" type="text" name="rate" value="5">
<p>Sub Items:</p>
<input type="text" name="subs[]" value="Cookies">
<input type="text" name="subs[]" value="Milk">
<input type="text" name="subs[]" value="Chips">
<br><br>
<input type="button" value="Compile" onClick="compileData()">
</body>
</html>
