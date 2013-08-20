<?php
$commands['showme'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=" . urlencode($param_str);
		$body = curl_get_contents($url);
		$response = json_decode($body);
		if(!empty($response->responseData->results)) {
			$index = array_rand($response->responseData->results);
			$conn->message($event['from'], $response->responseData->results[$index]->titleNoFormatting . " - " . $response->responseData->results[$index]->unescapedUrl, $event['type']);
		} else {
			$conn->message($event['from'], "Nada.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #showme <search terms>", $event['type']);
	}
}
?>
