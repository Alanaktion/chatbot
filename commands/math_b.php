<?php
$commands['math_b'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		try {
			$result = math_calculate(implode(" ", $params));
			$conn->message($event['from'], $result, $event['type']);
		} catch (Exception $e) {
			$conn->message($event['from'], "Error: " . $e->getMessage(), $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #math_b <expression>", $event['type']);
	}
}
?>
