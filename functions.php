<?php
session_start();
function signInUser($dataIn, $user_id) {
	$username = $dataIn[0]['username'];
	$password = hashPassword($username, $dataIn[0]['password']);
	$checkCredentials = mdl_checkCredentials($username, $password);
	if (count($checkCredentials) == 1) {
		$_SESSION['user_id'] = $checkCredentials[0]['user_id'];
		return '1';
	} else {
		return '0';
	}
}

function getUserList($dataIn, $user_id) {
	$dataOut = mdl_getItems($user_id);
	echo json_encode($dataOut);
}

function getSubItems($dataIn, $user_id) {
	$dataOut = mdl_getSubItems($dataIn[0]['item_id']);
	echo json_encode($dataOut);
}

function getTagCloud($dataIn, $user_id) {
	$dataOut = mdl_getTagCloud($user_id);
	echo json_encode($dataOut);
}

function hashPassword($username, $password) {
	$salt = md5($username);
	$password = hash('sha512', $password . $salt);
	return $password;
}
?>