<?php
$commands['fib'] = function(&$conn, $pl, $params) {
	if(!empty($params[0]) && intval($params[0]) > 0) { // && intval($params[0]) < 100000000000000) {
		$max = intval($params[0]);
		$fib = array(0,1);
		for ($i = 1; $i < $max; $i++) {
			$fib[] = $fib[$i]+$fib[$i-1];
		}
		$z = $fib[count($fib) - 1];
		$conn->message($pl['from'], $z, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #fib <max>", $pl['type']);
	}
}
?>
