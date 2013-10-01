<?php
$commands['clear'] = function(&$conn, $pl, $params) {
	if(!empty($params[0]) && intval($params[0]) > 0) {
		$lines = intval($params[0]);
	} else {
		$lines = 30;
	}
	$conn->message($pl['from'], str_repeat("\n", $lines), $pl['type']);
}
?>