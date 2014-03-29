<?php
session_start();
$name = 'NAGSESSION';
$expire = strtotime('-1 year');
$params = session_get_cookie_params();
$path = $params['path'];
$domain = $params['domain'];
$secure = $params['secure'];
$httponly = $params['httponly'];
setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
?>