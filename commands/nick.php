<?php
$commands['nick'] = function(&$conn, $pl, $params) {
	global $room, $room_server, $nick;
	if (!empty($params[0])) {
		$nick = implode(" ",$params);
		if($pl['type'] != "groupchat") {
			$conn->message($pl['from'], "Changing nickname...", $pl['type']);
		}
		$conn->joinRoom($room, $room_server, $nick);
	} else {
		$conn->message($pl['from'], "Usage: #nick <Nickname>", $pl['type']);
	}
}
?>
