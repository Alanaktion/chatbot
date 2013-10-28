<?php
$commands['slap'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);

		$short_from = mb_substr($pl['realfrom'], 0, mb_strpos($pl['realfrom'], "@"));
		if ($pl['type'] == "groupchat" && mb_strpos($pl['realfrom'],"/")) {
			$short_from = mb_substr($pl['realfrom'], mb_strpos($pl['realfrom'], "/") + 1);
		}

		$conn->message($pl['from'], $short_from . " slaps " . $param_str, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #slap <name>", $pl['type']);
	}
}
?>