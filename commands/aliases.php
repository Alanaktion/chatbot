<?php
$commands['aliases'] = function(&$conn, $pl, $params) {
	global $aliases;
	$list = array();
	foreach($aliases as $alias=>$command) {
		$list[] = $alias . " -> " . $command;
	}
	$msg = implode(", ", $list);
	$conn->message($pl['from'], rtrim($msg), $pl['type']);
}
?>
