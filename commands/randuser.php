<?php
$commands['randuser'] = function(&$conn, $event, $params) {
	try {
		$result = json_decode(curl_get_contents("http://api.randomuser.me/"));
		$user = $result->results[0]->user;
	} catch (Exception $e) {
		$conn->message($event['from'], "API call failed.", $event['type']);
		@print_r($result);
		return false;
	}

	// Build text response
	$text = '<a href="' . $user->picture->large . '">' . ucwords($user->name->first . " " . $user->name->last) . "</a><br />\n";
	$text .= "Email: " . $user->email . "<br />\n";
	$text .= "Phone: " . $user->phone;

	$conn->htmlmessage($event['from'], $text, $event['type']);
}
?>
