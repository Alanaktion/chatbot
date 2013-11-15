<?php
$commands['rejoin'] = function(&$conn, $pl, $params) {
	global $room, $room_server, $nick, $room_password;
	$param_str = implode(" ",$params);
	$conn->message($pl['from'], "Rejoining room...", $pl['type']);
	$conn->joinRoom($room, $room_server, $nick, $room_password);
}
?>
