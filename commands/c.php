<?php
$commands['c'] = function(&$conn, $event, $params) {
	global $chat_factory, $chat_c, $chat_session_c;

	if(!isset($chat_factory))
		$chat_factory = new ChatterBotFactory();
	if(!isset($chat_c))
		$chat_c = $chat_factory->create(ChatterBotType::CLEVERBOT);
	if(!isset($chat_session_c))
		$chat_session_c = $chat_c->createSession();

	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = $chat_session_c->think($param_str);
		$conn->message($event['from'], trim($response), $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #c <words, yo>", $event['type']);
	}
}
?>
