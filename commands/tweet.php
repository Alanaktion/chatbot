<?php
include_once dirname(__FILE__) . '/../lib/twitteroauth.php';
$commands['tweet'] = function(&$conn, $event, $params) {
	global $twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret;
	if(isset($params[0])) {
		$tweet = new TwitterOAuth($twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret);
		$message = implode(" ", $params);
		$post = $tweet->post("statuses/update", array("status" => $message));
		$conn->htmlmessage($event['from'], "<a href='https://twitter.com/{$post->user->screen_name}/statuses/{$post->id_str}'>Tweet posted.</a>", $event['type'], "Tweet posted: https://twitter.com/{$post->user->screen_name}/statuses/{$post->id_str}");
	} else {
		$conn->message($event['from'], "Usage: #tweet <message>", $event['type']);
	}
}
?>
