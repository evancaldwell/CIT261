<?php
$sessionLifetime = 60*60*24*30;

session_set_cookie_params($sessionLifetime);

if (!isset($_COOKIE['NAGSESSION'])) {
	session_id(generate_id());
}

session_start();

$params = session_get_cookie_params();

setcookie('NAGSESSION',session_id(),time()+$sessionLifetime, $params['path']);

function generate_id() {
	$customeSessionId = 'CUSTOM'.time().uniqid().stripIp();
	return $customeSessionId;
}
?>