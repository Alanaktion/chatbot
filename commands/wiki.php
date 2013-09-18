<?php
$commands['wiki'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "https://en.wikipedia.org/w/api.php?action=query&prop=info&format=json&titles=" . urlencode($param_str);
		$response = Unirest::get($url);
		print_r($response);
		if(!empty($response->body->query->pages)) {
			foreach($response->body->query->pages as $curpage) {
				$page = $curpage;
				break;
			}
			$conn->message($pl['from'], "https://en.wikipedia.org/wiki/" . ucfirst(str_replace(" ", "_", $page->title)), $pl['type']);
		} else {
			$conn->message($pl['from'], "Nothing found!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #wiki <search terms>", $pl['type']);
	}
}
?>
