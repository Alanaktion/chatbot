<?php

/* Need to add formatting to the message so I don't have to use monospace for everything
<message type='chat' id='purplefdf1031f' to='hashbot@chat.shelfreliance.com/hashbot'>
	<body>cool</body>
	<html xmlns='http://jabber.org/protocol/xhtml-im'>
		<body xmlns='http://www.w3.org/1999/xhtml'>
			<p>
				<span style='font-family: Raavi;'>cool</span>
			</p>
		</body>
	</html>
</message> */

$commands['shout'] = function(&$conn, $event, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		if($params[0] == "fonts") {
			$response = curl_get_contents("https://artii.herokuapp.com/fonts_list");
			$response = implode(", ", explode("\n", $response));
			$conn->message($event['from'], "\n" . $response, $event['type']);
		} elseif(substr($params[0], 0, 5) == "font=") {
			$font = substr($params[0], 5);
			unset($params[0]);
			$param_str = implode(" ",$params);
			$response = curl_get_contents("https://artii.herokuapp.com/make?text=" . urlencode($param_str) . "&font=" . urlencode($font));
			$conn->message($event['from'], "\n" . rtrim($response), $event['type']);
			//$conn->htmlmessage($event['from'], "<br><p style='font-family: monospace;'>" . nl2br(htmlentities(rtrim($response))) . '</p>', $event['type'], "\n" . rtrim($response));
		} else {
			$param_str = implode(" ",$params);
			$response = curl_get_contents("https://artii.herokuapp.com/make?text=" . urlencode($param_str));
			$conn->message($event['from'], "\n" . rtrim($response), $event['type']);
			//$conn->htmlmessage($event['from'], "<br><p style='font-family: monospace;'>" . nl2br(htmlentities(rtrim($response))) . '</p>', $event['type'], "\n" . rtrim($response));
		}
	} else {
		$conn->message($event['from'], "Usage: #shout [fonts|font=font] <words, yo>", $event['type']);
	}
}
?>
