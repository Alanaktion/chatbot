<?php
$commands['domain'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		//$response = curl_get_contents("http://alanaktion.net/tools/domains_api.php?domain=" . urlencode(implode(',',$params)));
		//$conn->message($event['from'], trim($response), $event['type']);
		$response = Unirest::get("http://domai.nr/api/json/info?q=" . urlencode($params[0]));
		print_r($response->body);
		if(!empty($response->body->error_message)) {
			$str = "Error: " . htmlentities($response->body->error_message);
		} else {
			$str = htmlentities($response->body->domain) . ": <a href='" . htmlentities($response->body->register_url) ."'>" . htmlentities($response->body->availability) . "</a>";
			/*if($response->body->availability == "available") {
				$str = "<span style='color: green;' title='{$response->body->availability}'>&#9642;</span> {$response->body->domain} <a href='" . htmlentities($response->body->register_url) ."'>Register</a>";
			} elseif($response->body->availability == "maybe") {
				$str = "<span style='color: darkyellow;' title='{$response->body->availability}'>&#9642;</span> {$response->body->domain} <a href='" . htmlentities($response->body->register_url) ."'>Check</a>";
			} else {
				$str = "<span style='color: red;' title='{$response->body->availability}'>&#9642;</span> {$response->body->domain}";
			}*/
		}
		$conn->htmlmessage($event['from'], $str, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #domain <domain>", $event['type']);
	}
}
?>
