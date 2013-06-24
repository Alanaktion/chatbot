<?php
$commands['fail'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$conn->message($pl['from'], "On a fail of 1-100, " . $param_str . " failed at " . rand(1, 100) . ".", $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #fail <who failed>", $pl['type']);
	}
}
?>
