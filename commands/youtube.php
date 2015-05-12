<?php
$commands['youtube'] = function(&$conn, $event, $params) {
	global $youtube_key;
	if (!empty($params[0])) {

		$param_str = implode(" ",$params);
		$url = "https://www.googleapis.com/youtube/v3/search?part=id%2Csnippet&type=video&q=" . urlencode($param_str) . "&key=" . urlencode($youtube_key);

		$result = json_decode(file_get_contents($url));

		if (isset($result->items[0])) {
			$video = $result->items[0];
			$url = 'https://www.youtube.com/watch?v=' . urlencode($video->id->videoId);
			$title = $video->snippet->title;

			$conn->htmlmessage($event['from'], "<a href='$url'>" . htmlentities($title) . "</a>", $event['type'], $url . " - " . $title);
		} else {
			$conn->message($event['from'], "Nothing found!", $event['type']);
		}

	} else {
		$conn->message($event['from'], "Usage: #yt|youtube <search terms>", $event['type']);
	}
}
?>
