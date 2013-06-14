<?php
$commands['ip'] = function(&$conn, $pl, $params) {
	global $mash_key;
	$response = Unirest::get("https://mark-sutuer-ip-utils.p.mashape.com/api.php?_method=getMyIp", array("X-Mashape-Authorization" => $mash_key));
	$conn->message($pl['from'], $response->body->myIp, $pl['type']);
}
?>
