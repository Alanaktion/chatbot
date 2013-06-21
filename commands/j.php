<?php
$commands['j'] = function(&$conn, $event, $params) {
	global $chat_factory, $chat_j, $chat_session_j;

	if(!isset($chat_factory))
		$chat_factory = new ChatterBotFactory();
	if(!isset($chat_j))
		$chat_j = $chat_factory->create(ChatterBotType::JABBERWACKY);
	if(!isset($chat_session_j))
		$chat_session_j = $chat_j->createSession();

	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = $chat_session_j->think($param_str);
		$conn->message($event['from'], trim($response), $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #j <words, yo>", $event['type']);
	}
}
?>
