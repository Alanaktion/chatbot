<?php
$commands['kick'] = function(&$conn, $pl, $params) use($room, $room_server) {
	if(!empty($params[0])) {
		$nick = $params[0];
		unset($params[0]);
		$message = implode(' ', $params);
		$conn->kickMember($room, $room_server, $nick, $message);
	} else {
		$conn->message($pl['from'], "Usage: #kick <nick> [message]", $pl['type']);
	}
}
?>
