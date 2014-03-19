<?php
//Nag database queries

//Connect to Database
$database = 'nagger261';
$db_username = 'root';
$db_password = 'root';
$server = 'localhost';
$dsn = "mysql:host=$server;dbname=$database";
try {
	$db = new PDO($dsn, $db_username, $db_password);
}
catch (PDOException $e) {
	$error_message = $e->getMessage();
}

//Check Users Credentials to sign them in
function mdl_checkCredentials($username, $password) {
	global $db;
	global $database;
	$sql = "SELECT user_id FROM user WHERE username = :username AND password = :password";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $result;
	}
	catch (PDOException $exc) {
		return '0';
	}
}

//Get all user's items
function mdl_getItems($user_id) {
	global $db;
	global $database;
	$sql = "SELECT item.item_id, rate.rate, item.item_name, (SELECT COUNT(sub_id) FROM subItem WHERE subItem.item_id = item.item_id) as subitems
			FROM item
			INNER JOIN rate
			ON item.rate_id = rate.rate_id
			WHERE user_id = :user_id
			AND completed = 'N'
			ORDER BY rate.rate ASC";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $result;
	}
	catch (PDOException $exc) {
		return '0';
	}
}

function mdl_getSubItems($item_id) {
	global $db;
	global $database;
	$sql = "SELECT sub_id, subItem FROM subItem WHERE item_id = :item_id";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':item_id', $item_id);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $result;
	}
	catch (PDOException $exc) {
		return '0';
	}
}

function mdl_getTagCloud($user_id) {
	global $db;
	global $database;
	$sql = "SELECT tn.tag, tc.tag_count
			FROM tagCount tc
			INNER JOIN tag tn
			ON tc.tag_id = tn.tag_id
			WHERE tc.user_id = :user_id";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $result;
	}
	catch (PDOException $exc) {
		return '0';
	}
}
?>