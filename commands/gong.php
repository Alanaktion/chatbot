<?php
$commands['gong'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "http://www.hark.com/clips/nxhncnjrqy-gong", $pl['type']);
}
?>
