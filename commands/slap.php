<?php
$commands['slap'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);

		$short_from = substr($pl['realfrom'], 0, strpos($pl['realfrom'], "@"));
		if ($pl['type'] == "groupchat" && strpos($pl['realfrom'],"/")) {
			$short_from = substr($pl['realfrom'], strpos($pl['realfrom'], "/") + 1);
		}

		$conn->message($pl['from'], $short_from . " slaps " . $param_str, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #slap <name>", $pl['type']);
	}
}
?>
