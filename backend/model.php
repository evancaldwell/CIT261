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
function mdl_insertItem($newItemId, $user_id, $itemRate, $itemName, $date) {
	global $db;
	global $database;
	$sql = "INSERT INTO item (item_id, user_id, rate_id, item_name, completed, date_created, rate_date)
			VALUES (:newItemId, :user_id, :itemRate, :itemName, 'N', :date_created, :rate_date)";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':newItemId', $newItemId);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':itemRate', $itemRate);
		$stmt->bindValue(':itemName', $itemName);
		$stmt->bindValue(':date_created', $date);
		$stmt->bindValue(':rate_date', $date);
		$stmt->execute();
		$stmt->closeCursor();
	}
	catch (PDOException $exc) {
	}
}
function mdl_insertSubItem($newSubItemId, $user_id, $newItemId, $sub) {
	global $db;
	global $database;
	$sql = "INSERT INTO subItem (sub_id, user_id, item_id, subItem, completed)
			VALUES (:newSubItemId, :user_id, :newItemId, :sub, 'N')";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':newSubItemId', $newSubItemId);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':newItemId', $newItemId);
		$stmt->bindValue(':sub', $sub);
		$stmt->execute();
		$stmt->closeCursor();
	}
	catch (PDOException $exc) {
	}
}
function mdl_checkWord($word) {
	global $db;
	global $database;
	$sql = "SELECT tag_id FROM tag WHERE tag = :word";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':word', $word);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $result;
	}
	catch (PDOException $exc) {
	}
}
function mdl_insertNewTag($newTagId, $tag) {
	global $db;
	global $database;
	$sql = "INSERT INTO tag (tag_id, tag) VALUES (:newTagId, :tag)";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':newTagId', $newTagId);
		$stmt->bindValue(':tag', $tag);
		$stmt->execute();
		$stmt->closeCursor();
	}
	catch (PDOException $exc) {
	}
}
function mdl_insertTagCount($newCountId, $user_id, $newTagId, $date) {
	global $db;
	global $database;
	$sql = "INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
			VALUES (:count_id, :user_id, :tag_id, '1', :last_updated)";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':count_id', $newCountId);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':tag_id', $newTagId);
		$stmt->bindValue(':last_updated', $date);
		$stmt->execute();
		$stmt->closeCursor();
	}
	catch (PDOException $exc) {
	}
}
function mdl_updateTagCount($user_id, $newTagId) {
	global $db;
	global $database;
	$sql = "UPDATE tagCount SET tag_count = tag_count + 1 WHERE user_id = :user_id AND tag_id = :tag_id";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':tag_id', $newTagId);
		$stmt->execute();
		$stmt->closeCursor();
	}
	catch (PDOException $exc) {
	}
}
function mdl_deleteItem($item_id, $user_id) {
	global $db;
	global $database;
	$sql = "DELETE FROM item WHERE item_id = :item_id AND user_id = :user_id";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':item_id', $item_id);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->execute();
		$stmt->closeCursor();
	}
	catch (PDOException $exc) {
	}
}

function mdl_getAllItems($user_id) {
	global $db;
	global $database;
	$sql = "SELECT item_id, rate_id, rate_date FROM item WHERE user_id = :user_id AND rate_id <> 1";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $result;
	}
	catch (PDOException $exc) {
	}
}
function mdl_updateRate($item_id, $user_id, $rate_id, $rate_date) {
	global $db;
	global $database;
	$sql = "UPDATE item SET rate_id = :rate_id WHERE item_id = :item_id AND user_id = :user_id;";
	$sql.= "UPDATE item SET rate_date = :rate_date WHERE item_id = :item_id AND user_id = :user_id;";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':rate_id', $rate_id);
		$stmt->bindValue(':item_id', $item_id);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':rate_date', $rate_date);
		$stmt->execute();
		$stmt->closeCursor();
	}
	catch (PDOException $exc) {
	}
}
?>