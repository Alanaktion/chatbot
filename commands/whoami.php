<?php
$commands['whoami'] = function(&$conn, $pl, $params) {
	$links = array(
		"https://www.youtube.com/watch?v=AK2B5ffWR6g&t=10",
		"http://bit.ly/GQ5vfd"
	);
	$i = rand(0,1);
	$conn->htmlmessage($pl['from'], "<a href='{$links[$i]}'>" . $pl['realfrom'] . "</a>", $pl['type'], $pl['realfrom']);
}
?>
