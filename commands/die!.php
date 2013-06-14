<?php
$commands['die!'] = function(&$conn, $event, $params) {
	// Don't allow a group message to kill the bot
	if($event['type'] == "chat") {
		$conn->message($pl['from'], "/me dies", $pl['type']);
		$conn->disconnect();
	} else {
		$conn->message($pl['from'], "/me decides not to die.", $pl['type']);
	}
}
?>
