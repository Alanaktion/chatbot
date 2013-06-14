<?php
$commands['pirate'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = file_get_contents("http://isithackday.com/arrpi.php?text=" . urlencode($param_str));
		$conn->message($pl['from'], $response, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #pirate <sentence>", $pl['type']);
	}
}
?>
