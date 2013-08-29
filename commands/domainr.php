<?php
$commands['domainr'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$response = Unirest::get("http://domai.nr/api/json/search?q=" . urlencode($params[0]));
		if(!empty($response->body->error_message)) {
			$str = "Error: " . $response->body->error_message;
		} else {
			$str = "Available domains:";
			foreach($response->body->results as $result) {
				$str .= "\n" . $result->subdomain . $result->path . ": ";
				if($result->availability == "available" || $result->availability == "maybe") {
					$str .= $result->availability . " - " . $result->register_url;
				} else {
					$str .= $result->availability;
				}
			}
		}
		$conn->message($event['from'], $str, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #domainr <name>", $event['type']);
	}
}
?>
