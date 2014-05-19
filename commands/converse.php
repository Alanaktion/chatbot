<?php
$commands['converse'] = function(&$conn, $event, $params) {
	global $chat_factory, $chat_j, $chat_p;

	if(!isset($chat_factory))
		$chat_factory = new ChatterBotFactory();
	if(!isset($chat_j))
		$chat_j = $chat_factory->create(ChatterBotType::JABBERWACKY);
	if(!isset($chat_p))
		$chat_p = $chat_factory->create(ChatterBotType::PANDORABOTS, 'cca4a7a23e347bc7'); // b0dafd24ee35a477
	$chat_session_j = $chat_j->createSession();
	$chat_session_p = $chat_p->createSession();

	if (!empty($params[0]) && intval($params[0]) > 0 && intval($params[0]) <= 20 && !empty($params[1])) {
		$count = intval($params[0]);
		unset($params[0]);
		$response = implode(" ",$params);
		for($i = 0; $i < $count; $i++) {
			// Pandorabot
			$response = $chat_session_p->think($response);
			$msg = "<span style=\"color: blue;\">PB:</span> " . trim($response) . " <span style=\"color: #777;\">[" . ($i + 1) . "/" . $count . "]</span>";
			echo strip_tags($msg) . "\n";
			$conn->htmlmessage($event['from'], $msg, $event['type']);
			// Jabberwacky
			$response = $chat_session_j->think($response);
			$msg = "<span style=\"color: red;\">JW:</span> " . trim($response) . " <span style=\"color: #777;\">[" . ($i + 1) . "/" . $count . "]</span>";
			echo strip_tags($msg) . "\n";
			$conn->htmlmessage($event['from'], $msg, $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #converse <message count> <start phrase>", $event['type']);
	}
}
?>
