<?php
$commands['rapewhistle'] = function(&$conn, $pl, $params) {
	$urls = array(
		"http://www.thrivelife.com/whistle.html",
		"http://www.thrivelife.com/metal-whistle.html",
		"http://x.co/rapewhistl",
		"http://5z8.info/how2pipebomb_j6n7fu_launchexe",
	);
	shuffle($urls);
	$conn->message($pl['from'], $urls[0], $pl['type']);
}
?>
