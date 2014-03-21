<?php
$commands["password"] = function(&$conn, $event, $params) {
	$length = 8;
	if(!empty($params[0]) && intval($params[0]) > 0) {
		$length = intval($params[0]);
	}

	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	$password = substr(str_shuffle($chars), 0, $length);

	$conn->message($event["from"], $password, $event["type"]);}
?>
