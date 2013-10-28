<?php
$commands['rapewhistle'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "http://www.thrivelife.com/whistle.html", $pl['type']);
}
?>
