<?php
$commands['domain'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$response = curl_get_contents("http://alanaktion.net/tools/domains_api.php?domain=" . urlencode(implode(',',$params)));
		$conn->message($event['from'], trim($response), $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #domain <domain> [...]", $event['type']);
	}
}
?>
