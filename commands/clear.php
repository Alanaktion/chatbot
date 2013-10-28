<?php
$commands['clear'] = function(&$conn, $pl, $params) {
	if(isset($params[0])) {
		if($params[0] > 100) {
			$conn->message($pl['from'], "Yeah, no.", $pl['type']);
			return;
		} elseif(intval($params[0]) > 0) {
			$lines = intval($params[0]);
		}
	} else {
		$lines = 30;
	}
	if(!empty($lines)) {
		$conn->message($pl['from'], str_repeat("\n", $lines), $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #clear [lines]", $pl['type']);
	}
}
?>