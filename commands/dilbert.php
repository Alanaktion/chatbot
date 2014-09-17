<?php
$commands['dilbert'] = function(&$conn, $pl, $params) {
	$date = date("Y-m-d", rand(strtotime("1989-04-16"), time()));
	$conn->message($pl['from'], "http://dilbert.com/fast/" . $date . "/", $pl['type']);
}
?>
