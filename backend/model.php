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

//Sarah's Account
$user_id = '239487g234y32g4i2376g4i';

//John's Account
//$user_id = 'JOHN32032943204923488';

//Database Queries

//Get all user's items
function mdl_getItems($user_id) {
	global $db;
	global $database;
	$sql = "SELECT item.item_id, rate.rate, item.item
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
?>