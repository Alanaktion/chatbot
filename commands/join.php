<?php
$commands['join'] = function(&$conn, $event, $params) {
	global $server, $user;
	if (!empty($params[0])) {
		// Determine joinRoom() params
		$room = $params[0];
		$room_server = !empty($params[1]) ? $params[1] : 'conference.' . $server;
		$nick = !empty($params[2]) ? $params[2] : $user;
		$room_password = !empty($params[3]) ? $params[3] : false;

		// Attempt to join the room
		$conn->joinRoom($room, $room_server, $nick, $room_password);
		$conn->message($event['from'], "Joining room {$room}@{$room_server} as {$nick}", $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #join <room> [room_server] [nick] [password]", $event['type']);
	}
}
?>

