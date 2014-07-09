<?php
$commands['scrumtime'] = function(&$conn, $pl, $params) {
	$colors = array(
		'ff00ff',
		'ff0066',
		'ff3300',
		'ffcc00',
		'99ff00',
		'00ff00',
		'00ff99',
		'00ccff',
		'0033ff',
		'6600ff',
	);
	foreach(str_split("SCRUMTIME!") as $i=>$char) {
		$conn->htmlmessage($pl['from'], "<p style='font-size: large; font-weight: bold; color:#{$colors[$i]};  background: #000; padding:0 60px;'>   $char   </p>", $pl['type']);
		usleep(90000);
	}
};
