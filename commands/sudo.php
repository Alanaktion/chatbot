<?php
$commands['sudo'] = function(&$conn, $pl, $params) {
	if(!empty($params[0])) {
		$conn->message($pl['from'], "Okay.", $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #sudo <command>", $pl['type']);
	}
}
?>
