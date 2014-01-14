<?php
include_once dirname(__FILE__) . '/../lib/evalmath.class.php';
$commands['math'] = function(&$conn, $event, $params) {
	global $math;
	if(isset($params[0])) {
		// Reset EvalMath
		if($params[0] == "reset" || $params[0]=="clear") {
			unset($math);
			$conn->message($event['from'], "Calculator reset.", $event['type']);
			return;
		}

		// Show user defined variables
		if($params[0] == "vars") {
			$vars = $math->vars();
			$conn->message($event['from'], print_r($vars, true), $event['type']);
			return;
		}

		if(empty($math)) {
			$math = new EvalMath();
		}
		$expr = str_replace(",", "", implode(" ", $params));
		$result = $math->evaluate($expr);
		if($result === false) {
			$conn->htmlmessage($event['from'], "<p style='color: red;'>Error: " . htmlentities($math->last_error) . "</p>", $event['type']);
		} elseif($result > 1000) {
			$conn->message($event['from'], number_format($result), $event['type']);
		} else {
			$conn->message($event['from'], $result, $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #math <expression|clear|reset>", $event['type']);
	}
}
?>
