<?php
$commands['fail'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		if(rand(1,10) == 1) {
			$conn->message($pl['from'], $param_str . "'s fail level is over 9000!!!!!!!11", $pl['type']);
		} else {
			$conn->message($pl['from'], "On a fail of 1-100, " . $param_str . " failed at " . rand(1, 100) . ".", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #fail <who failed>", $pl['type']);
	}
}
?>
