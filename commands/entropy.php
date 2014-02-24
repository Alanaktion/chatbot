<?php
$commands['entropy'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$str = implode(" ",$params);
		$len=strlen($str);
		$entropy =  4 * min($len, 1) + ($len > 1 ? (2 * (min($len, 8) - 1)) : 0) + ($len > 8 ? (1.5 * (min($len, 20) - 8)) : 0) + ($len > 20 ? ($len - 20) : 0) + 6 * (bool)(preg_match('/[A-Z].*?[0-9[:punct:]]|[0-9[:punct:]].*?[A-Z]/', $str));
		if($entropy < 20) {
			$result = "Weak";
		} elseif($entropy < 25) {
			$result = "Moderate";
		} else {
			$result = "strong";
		}
		$conn->message($pl['from'], $entropy . " ($result)", $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #1337 <sentence>", $pl['type']);
	}
}
?>
