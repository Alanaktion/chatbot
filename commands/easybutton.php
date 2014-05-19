<?php
$commands['easybutton'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "That was easy.", $pl['type']);
}
?>
