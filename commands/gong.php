<?php
$commands['gong'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "http://x.co/gonnng", $pl['type']);
}
?>
