<?php
$commands['p'] = function(&$conn, $event, $params) {
	global $chat_factory, $chat_p, $chat_session_p;

	if(!isset($chat_factory))
		$chat_factory = new ChatterBotFactory();
	if(!isset($chat_p))
		$chat_p = $chat_factory->create(ChatterBotType::PANDORABOTS, 'cca4a7a23e347bc7'); // b0dafd24ee35a477
	if(!isset($chat_session_p))
		$chat_session_p = $chat_p->createSession();

	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = $chat_session_p->think($param_str);
		$response = strip_tags(str_replace(array("<br />","<br>","<br/>"),"\r\n",$response));
		$conn->message($event['from'], trim($response), $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #p <words, yo>", $event['type']);
	}
}
?>
