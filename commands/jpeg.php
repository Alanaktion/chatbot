<?php

// Google's a random image for the terms, then more jpegs it.

$commands['jpeg'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=" . urlencode($param_str);
		$body = curl_get_contents($url);
		$response = json_decode($body);
		if(!empty($response->responseData->results)) {
			$conn->message($event['from'], "Found image, JPEGing it...", $event['type']);
			$index = array_rand($response->responseData->results);
			$src = $response->responseData->results[$index]->unescapedUrl;
			$result = curl_post_get_contents("http://needsmorejpeg.com/process", array("image" => $src), null);
			print_r($result);
			if(preg_match("#/i/[0-9a-z]+\\.jpe?g#i", $result, $matches)) {
				print_r($matches);
				$jpeg = $matches[0];
				$conn->message($event['from'], $response->responseData->results[$index]->titleNoFormatting . " - http://needsmorejpeg.com" . $jpeg, $event['type']);
			} else {
				$conn->message($event['from'], "Failed to JPEG :(", $event['type']);
			}
		} else {
			$conn->message($event['from'], "Nada.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #jpeg <search terms>", $event['type']);
	}
}
?>
