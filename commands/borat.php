<?php
include_once dirname(__FILE__) . '/../lib/twitteroauth.php';
$commands['borat'] = function(&$conn, $event, $params) {
	global $twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret;

	$twitter = new TwitterOAuth($twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret);
	$tweets = $twitter->get("statuses/user_timeline", array("screen_name" => "DEVOPS_BORAT", "trim_user" => true, "count" => 50));

	$tweet = $tweets[array_rand($tweets)];

	if($tweet) {
		$conn->message($event['from'], $tweet->text, $event['type']);
	} else {
		print_r($tweets);
		$conn->message($event['from'], "Unable to load tweet :(", $event['type']);
	}

}
?>
