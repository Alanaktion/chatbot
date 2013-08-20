<?php
$commands['translate'] = function(&$conn, $event, $params) {
	global $translate_token, $token_response;
	if(empty($translate_token)) {
		$token_request = http_build_query(array(
			"client_id" => $client_id,
			"client_secret" => $client_secret,
			"scope" => "http://api.microsofttranslator.com",
			"grant_type" => "client_credentials",
		), "", "&");
		$token_response = Unirest::post("https://datamarket.accesscontrol.windows.net/v2/OAuth2-13?" . $token_request); //, array(), $token_request);
		if(!empty($token_reponse->body->access_token)) {
			$translate_token = $token_reponse->body->access_token;
		} else {
			print_r($token_response->body);
			$conn->message($event['from'], "Failed to retrieve access token.", $event['type']);
		}
	}
	if (!empty($params[0]) && !empty($params[1]) && !empty($params[2])) {
		$to = $params[0];
		$from = $params[1];
		unset($params[0], $params[1]);
		$message = implode(" ", $params);

		$url = "http://api.microsofttranslator.com/v2/Http.svc/Translate?text=" . urlencode($message) . "&from=" . urlencode($from) . "&to=" . urlencode($to);
		$headers = array("Authorization" => "Bearer $translate_token");
		$result = Unirest::post($url, $headers);

		print_r($response->body);

		$conn->message($event['from'], $result->raw_body, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #translate <to> <from> <message>", $event['type']);
	}
}
?>
