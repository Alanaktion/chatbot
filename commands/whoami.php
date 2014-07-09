<?php
$commands['whoami'] = function(&$conn, $pl, $params) {
	$links = array(
		"https://www.youtube.com/watch?v=AK2B5ffWR6g&t=10",
		"http://bit.ly/GQ5vfd"
	);
	$conn->htmlmessage($pl['from'], "<a href='" . htmlentities($links[array_rand($links)]) . "'>" . $pl['realfrom'] . "</a>", $pl['type'], $pl['realfrom']);
}
?>
