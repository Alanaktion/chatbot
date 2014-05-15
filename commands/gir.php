<?php
$commands['gir'] = function(&$conn, $event, $params) {
	$responses = array(
		"Doom doom, doom doom doom dooooooom.",
		"I am government man, come from the government. The government has sent me.",
		"MONKEY!",
		"I miss you cupcake.",
		"CHICKEN! I'm gonna eat you!",
		"I'm gonna roll around on the floor for a while. KAY?",
		"Aww, but I wanna watch the Scary Monkey Show!",
		"Okey dokey!",
		"Hi floor! Make me a sandwich!",
		"Your methods are stupid; your progress has been stupid; your intelligence is stupid!",
		"Lets make biscuits! LETS MAKE BISCUITS!",
		"I'm gonna sing the Doom Song now. Doom doom doom doom doom doom doom doom doom doom doom doom doom doom doom doom doom doom doom doom",
		"Doom doom doom doom doomy doomy doom doomy doom doom doom doom doom doom doom",
		"Aww, it likes me.",
		"YAY!",
		"I love this show!"
	);
	$conn->message($event['from'], $responses[array_rand($responses)], $event['type']);
}
?>
