<?php
$commands['kirbydance'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "<(^.^<)", $pl['type']);
	sleep(1);
	$conn->message($pl['from'], "(>^.^)>", $pl['type']);
	sleep(1);
	$conn->message($pl['from'], "<(^.^<)", $pl['type']);
	sleep(1);
	$conn->message($pl['from'], "(>^.^)>", $pl['type']);
}
?>
