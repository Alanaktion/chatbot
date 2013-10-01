<?php
$commands['aliases'] = function(&$conn, $pl, $params) {
	global $aliases;
	foreach($aliases as $alias=>$command) {
		$msg .= $alias . ": " . $command . "\n";
	}
	$conn->message($pl['from'], rtrim($msg), $pl['type']);
}
?>
