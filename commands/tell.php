<?php
$commands['tell'] = function(&$conn, $pl, $params) {
	global $room, $room_server;
	if(!empty($params[0])) {
		$to = $params[0];
		unset($params[0]);
		if($to = $room . "@" . $room_server) {
			$pl['type'] = "groupchat";
		}
		try {
			$conn->message($to, implode(" ",$params), $pl['type']);
		} catch(Exception $ex) {
			var_dump($ex);
			$conn->message($pl['from'], "Fatal Error! See console for details.", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #tell <user@host> <message>", $pl['type']);
	}
}
?>
