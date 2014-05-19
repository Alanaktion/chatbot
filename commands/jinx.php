<?php
$commands['jinx'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$array_of_lots_of_stuff = array('soda','donut','quarter','punch in the face');

		$short_from = mb_substr($pl['realfrom'], 0, mb_strpos($pl['realfrom'], "@"));
		if ($pl['type'] == "groupchat" && mb_strpos($pl['realfrom'],"/")) {
			$short_from = mb_substr($pl['realfrom'], mb_strpos($pl['realfrom'], "/") + 1);
		}

		$conn->message($pl['from'], $param_str . " owes " . $short_from . " a " . $array_of_lots_of_stuff[array_rand($array_of_lots_of_stuff)], $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #jinx <name>", $pl['type']);
	}
}
?>