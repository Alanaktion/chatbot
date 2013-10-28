<?php
$commands['google'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "https://ajax.googleapis.com/ajax/services/search/web?v=1.0&rsz=1&q=" . urlencode($param_str);
		$response = Unirest::get($url); //, array("Referer" => "https://github.com/Alanaktion/chatbot"));
		if (!empty($response->responseData->results[0])) {
			$top = $response->responseData->results[0];
			$conn->message($pl['from'], html_entity_decode($top->titleNoFormatting) . " " . rawurldecode($top->url), $pl['type']);
		} elseif(!empty($response->responseDetails)) {
			$conn->message($pl['from'], $response->responseDetails, $pl['type']);
		} else {
			$conn->message($pl['from'], "Nothing found!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #google <search terms>", $pl['type']);
	}
}
?>
