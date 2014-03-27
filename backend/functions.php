<?php
$hashMap = array(
  'signInUser' => signInUser
, 'createUser' => createUser
, 'getUserList' => getUserList
, 'getSubItems' => getSubItems
, 'getTagCloud' => getTagCloud
, 'insertItem' => insertItem 
);

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

function insertItem($dataIn, $user_id) {
	$itemName = $dataIn[0]['name'];
	$itemRate = $dataIn[0]['rate'];
	$subItems = $dataIn[0]['subItems'];
	$newItemId = uniqid('', true);
	$date = date('Y-m-d');
	mdl_insertItem($newItemId, $user_id, $itemRate, $itemName, $date);
	if (!empty($subItems)) {
		foreach ($subItems as $sub) {
			$newSubItemId = uniqid('', true);
			mdl_insertSubItem($newSubItemId, $user_id, $newItemId, $sub);
		}
	}
	$itemWords = explode(' ', $itemName);
	foreach ($itemWords as $tag) {
		$tag = strtolower($tag);
		$checkWord = mdl_checkWord(strtolower($tag));
		if (empty($checkWord)) {
			$newTagId = uniqid('', true);
			$newCountId = uniqid('', true);
			mdl_insertNewTag($newTagId, $tag);
			mdl_insertTagCount($newCountId, $user_id, $newTagId, $date);
		}
		else {
			mdl_updateTagCount($user_id, $checkWord[0]['tag_id']);
		}
	}
}

function hashPassword($username, $password) {
	$salt = md5($username);
	$password = hash('sha512', $password . $salt);
	return $password;
}
?>