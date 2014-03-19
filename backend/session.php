<?php
$sessionLifetime = 15;

session_set_cookie_params($sessionLifetime);

if (!isset($_COOKIE['PHPSESSID'])) {
	session_id(generate_id());
}

session_start();

$params = session_get_cookie_params();

setcookie(session_name(),session_id(),time()+$sessionLifetime, $params['path']);

function generate_id() {
	$customeSessionId = 'CUSTOM'.time().uniqid().stripIp();
	return $customeSessionId;
}
?>