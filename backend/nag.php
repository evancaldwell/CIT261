<?php
//Nag Server Functions File

include('model.php');

//Create Command Map
$HashMap = array(
'getUserList' => getUserList
);

//Call the requested function with the sent data
$cmd = $_POST['cmd'];
$dataString = $_POST['data'];
$func_to_call = $HashMap[$cmd];
if (!empty($func_to_call)) {
	$func_to_call(json_decode($dataString));
}

//Functions
//Send back DATA as JSON
function getUserList($dataIn) {
	$dataOut = mdl_getItems('239487g234y32g4i2376g4i');
	echo json_encode($dataOut);
}
getUserList();
?>