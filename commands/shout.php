<?php
$commands['shout'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		if($params[0] == "fonts") {
			$response = curl_get_contents("https://artii.herokuapp.com/fonts_list");
			$response = implode(", ", explode("\n", $response));
			$conn->message($pl['from'], "\n" . $response, $pl['type']);
		} elseif(substr($params[0], 0, 5) == "font=") {
			$font = substr($params[0], 5);
			unset($params[0]);
			$param_str = implode(" ",$params);
			$response = curl_get_contents("https://artii.herokuapp.com/make?text=" . urlencode($param_str) . "&font=" . urlencode($font));
			$conn->message($pl['from'], "\n" . rtrim($response), $pl['type']);
		} else {
			$param_str = implode(" ",$params);
			$response = curl_get_contents("https://artii.herokuapp.com/make?text=" . urlencode($param_str));
			$conn->message($pl['from'], "\n" . rtrim($response), $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #shout [fonts|font=font] <words, yo>", $pl['type']);
	}
}
?>
