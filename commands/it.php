<?php
$commands['it'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "/me pounds it.", $pl['type']);
}
?>
