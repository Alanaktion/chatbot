<?php
include_once dirname(__FILE__) . '/../lib/twitteroauth.php';
$commands['borat'] = function(&$conn, $event, $params) {
	global $twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret, $devops_borat_feed;

	if(empty($devops_borat_feed)) {
		$twitter = new TwitterOAuth($twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret);
		$devops_borat_feed = $twitter->get("statuses/user_timeline", array("screen_name" => "DEVOPS_BORAT", "trim_user" => true, "count" => 3000));
	}

	$tweet = $devops_borat_feed[array_rand($devops_borat_feed)];

	if($tweet) {
		$conn->message($event['from'], $tweet->text, $event['type']);
	} else {
		print_r($devops_borat_feed);
		unset($devops_borat_feed);
		$conn->message($event['from'], "Unable to load tweet :(", $event['type']);
	}

}
?>
