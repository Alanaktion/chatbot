<?php
$commands['whoami'] = function(&$conn, $pl, $params) {
	$conn->htmlmessage($pl['from'], "<a href='http://bit.ly/GQ5vfd'>" . $pl['realfrom'] . "</a>", $pl['type'], $pl['realfrom']);
}
?>
