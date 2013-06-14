<?php
$commands['startup'] = function(&$conn, $pl, $params) {
	$response = json_decode(file_get_contents("http://itsthisforthat.com/api.php?json"));
	$conn->message($pl['from'], $response->this . " for " . $response->that, $pl['type']);
}
?>
