<?php
$commands['ip'] = function(&$conn, $pl, $params) {
	$response = curl_get_contents("http://bot.whatismyipaddress.com/");
	$conn->message($pl['from'], $response, $pl['type']);
}
?>
