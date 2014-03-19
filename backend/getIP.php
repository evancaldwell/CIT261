<?php
function getIp() {
	$ip = getenv('HTTP_CLIENT_IP')
		?: getenv('HTTP_X_FORWARDED_FOR')
		?: getenv('HTTP_X_FORWARDED')
		?: getenv('HTTP_FORWARDED_FOR')
		?: getenv('HTTP_FORWARDED')
		?: getenv('REMOTE_ADDR');	
	return $ip;
}

function stripIp() {
	$ip = getIp();
	$replace = array(' ', ':', '.');
	$newIP = str_replace($replace, '', $ip);
	return $newIP;
}
?>