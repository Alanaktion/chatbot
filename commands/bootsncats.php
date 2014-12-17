<?php
$commands['bootsncats'] = function(&$conn, $event, $params) {
	$str = "boots and cats";
	$cat = " and ";
	if(empty($params)) {
		$conn->message($event['from'], "Usage: #bootsncats <count>", $event['type']);
	} elseif ($params[0] > 200) {
		$conn->message($event['from'], "Nope :P", $event['type']);
	} else {
		$arr = array();
		for($i = 0; $i < $params[0]; $i++) {
			$arr[] = $str;
		}
		$conn->message($event['from'], ucfirst(implode($cat, $arr)) . ".", $event['type']);
	}
}
?>
