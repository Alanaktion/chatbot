<?php
$commands['ud'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$text = implode(" ",$params);
		$result = json_decode(file_get_contents("http://api.urbandictionary.com/v0/define?term=" . urlencode($text)));
		if($result->result_type != "no_results") {
			$def = $result->list[0];
			/* $str = "<strong>" . htmlspecialchars($def->word) . "</strong>:<br>\n";
			$str .= htmlspecialchars($def->definition) . "<br>\n";
			$str .= "<em>" . htmlspecialchars($def->example) . "</em>";
			$conn->htmlmessage($event['from'], $str, $event['type']); */
			$str = $def->word . ": " . $def->definition . "\n";
			$str .= "\"" . $def->example . "\"";
			$conn->message($event['from'], $str, $event['type']);
		} else {
			$conn->message($event['from'], "Nada.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #ud <word>", $event['type']);
	}
}
?>