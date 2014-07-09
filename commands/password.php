<?php
$commands["password"] = function(&$conn, $event, $params) use ($wordlist) {
	if(empty($wordlist)) {
		$wordfile = file_get_contents(dirname(__FILE__) . "/../res/wordlist.txt");
		$wordlist = explode(",", $wordfile);
	}

	$words = $wordlist;

	shuffle($words);
	shuffle($nums);

	// Start with two words
	$pass = ucfirst($words[0]) . ucfirst($words[1]);

	$len = 15;
	if(!empty($params[0]) && is_numeric($params[0])) {
		if($params[0] > 200) {
			$conn->message($event["from"], "Maximum length is 200 characters.", $event["type"]);
			return;
		}
		$len = intval($params[0]);
	}

	$i = 2;
	while(strlen($pass) < $len) {
		$pass .= ucfirst($words[$i]);
		$i++;
	}

	if(rand(0,1)) {
		$pass .= rand(0,9);
	}

	$conn->message($event["from"], $pass, $event["type"]);
}
?>
