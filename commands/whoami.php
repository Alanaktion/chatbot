<?php
$commands['whoami'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], $pl['realfrom'] . " bit.ly/GQ5vfd", $pl['type'] );
}
?>
