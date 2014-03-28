<?php
date_default_timezone_set('America/Denver');

include('getIP.php');
include('model.php');
include('session.php');
include('functions.php');

$func_to_call = $hashMap[$_REQUEST['cmd']];
$dataIn = json_decode($_REQUEST['data'], true);
if (!isset($_SESSION['user_id']) && $func_to_call == 'signInUser') {
	$test = $func_to_call($dataIn);
	if ($test == 0) {
		setcookie('NAGSESSION', '',time()-3600, $params['path']);
	}
}
elseif (isset($_SESSION['user_id']) && !empty($func_to_call) && $func_to_call != 'signInUser') {
	$user_id = $_SESSION['user_id'];
	$func_to_call($dataIn, $user_id);
} else {
	setcookie('NAGSESSION', '',time()-3600, $params['path']);
}

?>