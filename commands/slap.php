<?php
$commands['slap'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$conn->message($pl['from'], $pl['from'] . " slaps " . $param_str, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #slap <name>", $pl['type']);
	}
}
?>
