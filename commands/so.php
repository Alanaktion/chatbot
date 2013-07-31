<?php
# https://api.stackexchange.com/2.1/search
$commands['so'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "It's failing for some reason, I'll fix it later.", $pl['type']);
	return;
	if (!empty($params[0])) {
		$param_str = implode(" ", $params);
		//$tags = implode(";", $params);
		$url = "https://api.stackexchange.com/2.1/search?sort=relevance&site=stackoverflow&intitle=" . urlencode($param_str); // . "&tagged=" . urlencode($tags);
		$json = file_get_contents($url);
		echo $json;
		$response = json_decode($json, true);
		file_put_contents("C:/Alan/GitHub/chatbot.log", print_r($response,true));
		print_r($response);
		if (isset($response['items'][0])) {
			$top = $response['items'][0];
			$conn->message($pl['from'], $top['title'] . " " . $top['link'], $pl['type']);
		} else {
			$conn->message($pl['from'], "Nothing found!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #so <search terms>", $pl['type']);
	}
}
?>
