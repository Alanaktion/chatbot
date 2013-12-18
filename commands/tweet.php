<?php
include_once dirname(__FILE__) . '/../lib/twitteroauth.php';
$commands['tweet'] = function(&$conn, $event, $params) {
	global $twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret;
	if(isset($params[0])) {
		$tweet = new TwitterOAuth($twitterConsumerKey, $twitterConsumerSecret, $twitterOAuthToken, $twitterOAuthSecret);
		$message = implode(" ", $params);
		if(strlen($message) > 140) {
			$conn->message($event['from'], "Error: tweets must be 140 characters or less. That message is " . strlen($message) . ".", $event['type']);
			return false;
		}

		$post = $tweet->post("statuses/update", array("status" => $message));
		if(!empty($post->id)) {
			$conn->htmlmessage($event['from'], "<a href='https://twitter.com/{$post->user->screen_name}/statuses/{$post->id_str}'>Tweet posted to @{$post->user->screen_name}.</a>", $event['type'], "Tweet posted: https://twitter.com/{$post->user->screen_name}/statuses/{$post->id_str}");
		} else {
			$conn->message($event['from'], "Failed to post tweet!", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #tweet <message>", $event['type']);
	}
}
?>
