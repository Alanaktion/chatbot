<?php
$commands['domainr'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$response = Unirest::get("http://domai.nr/api/json/search?q=" . urlencode($params[0]));
		if(!empty($response->body->error_message)) {
			$str = "Error: " . $response->body->error_message;
		} else {
			$str = "";
			foreach($response->body->results as $result) {
				if(($result->availability == "available" || $result->availability == "maybe") && empty($result->path)) {
					//$str .= "\n" . $result->subdomain . $result->path . ": ";
					$str .= "\n" . $result->subdomain . ": " . $result->availability . " - " . $result->register_url;
				/*} else {
					$str .= $result->availability;*/
				}
			}
			if(!$str) {
				$str = "No matching domains available.";
			} else {
				$str = "Available domains:" . $str;
			}
		}
		$conn->message($event['from'], $str, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #domainr <name>", $event['type']);
	}
}
?>
