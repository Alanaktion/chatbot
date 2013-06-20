<?php
$commands['backwards'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$conn->message($pl['from'], strrev($param_str), $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #backwards <words, yo>", $pl['type']);
	}
}
?>
