<?php
$commands["urlencode"] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$conn->message($event["from"], urlencode($param_str), $event["type"]);
	} else {
		$conn->message($event["from"], "Usage: #urlencode <string>", $event["type"]);
	}
}
?>
