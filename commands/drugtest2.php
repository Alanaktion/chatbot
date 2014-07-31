<?php
$commands['drugtest2'] = function(&$conn, $event, $params) {
	$responses = array(
		"Alan",
		"ALAN",
		"~A~~L~AN"
	);
	$conn->message($event['from'], $responses[array_rand($responses)], $event['type']);
}
?>
