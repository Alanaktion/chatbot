<?php
$commands['!'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "New Twitter doesn't use a hashbang anymore, history.pushState() was better.", $pl['type']);
}
?>
