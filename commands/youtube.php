<?php
$commands['youtube'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "http://gdata.youtube.com/feeds/api/videos?q=" . urlencode($param_str) . "&alt=json";
		$result = json_decode(file_get_contents($url), true);
		if (isset($result['feed']['entry'][0])) {
			$video = $result['feed']['entry'][0];
			$conn->message($pl['from'], $video['title']['$t'] . " " . $video['link'][0]['href'], $pl['type']);
		} else {
			$conn->message($pl['from'], "Nothing found!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #yt|youtube <search terms>", $pl['type']);
	}
}
?>
