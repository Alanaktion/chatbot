<?php
$commands['domain'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		//$response = curl_get_contents("http://alanaktion.net/tools/domains_api.php?domain=" . urlencode(implode(',',$params)));
		//$conn->message($event['from'], trim($response), $event['type']);
		$response = Unirest::get("http://domai.nr/api/json/info?q=" . urlencode($params[0]));
		if(!empty($response->body->error_message)) {
			$str = "Error: " . $response->body->error_message;
		} else {
			$str = $response->body->domain . ": " . $response->body->availability;
		}
		$conn->message($event['from'], $str, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #domain <domain>", $event['type']);
	}
}
?>
