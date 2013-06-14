<?php
$commands['whoami'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], $pl['realfrom'], $pl['type']);
}
?>
