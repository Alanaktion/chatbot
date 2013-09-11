<?php
$commands['win'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "Woohoo!", $pl['type']);
}
?>
