<?php
$commands['math'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		// Get Google API result
		$str = curl_get_contents("https://www.google.com/ig/calculator?q=" . urlencode(implode(" ", $params)));

		// Fix Google's crap JSON
		$str = str_replace(array("lhs:","rhs:","error:","icc:"),array('"lhs":','"rhs":','"error":','"icc":'),$str);
		$result = json_decode($str);

		if(!empty($result->rhs)) {
			$conn->message($event['from'], $result->rhs, $event['type']);
		} elseif(!empty($result->error)) {
			$conn->message($event['from'], $result->error, $event['type']);
		} else {
			print_r($result);
			echo $str;
			$conn->message($event['from'], "API Error", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #math <expression>", $event['type']);
	}
}
?>
