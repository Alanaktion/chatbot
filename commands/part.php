<?php
$commands['part'] = function(&$conn, $pl, $params) {
	global $room, $room_server, $nick, $room_password;

	// Don't allow a group message to kill the bot
	if($pl['type'] == "chat") {
		if(strpos($pl['from'],"ahardman") !== false) {
			$conn->message($pl['from'], "/me leaves the room", $pl['type']);
			$status = null;
			if(!empty($params[0])) {
				$status = implode(" ", $params);
			}
			$conn->leaveRoom($room, $room_server, $nick, $status);
		}
	} else {
		$conn->message($pl['from'], "This command tells me to leave the room. Only my master can use it.", $pl['type']);
	}
}
?>
