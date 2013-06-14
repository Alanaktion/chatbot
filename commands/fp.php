<?php
$commands['fp'] = function(&$conn, $event, $params) {
	$img = str_pad(rand(0, 45), 2, 0, STR_PAD_LEFT);
	$conn->message($event['from'], "http://facepalm.org/images/{$img}.jpg", $event['type']);
}
?>
