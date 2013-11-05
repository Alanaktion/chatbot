<?php
include_once dirname(__FILE__) . '/../lib/evalmath.class.php';
$commands['math'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$math = new EvalMath();
		$result = $math->evaluate(implode(" ", $params));
		$conn->message($event['from'], $result, $event['type']);

		// Well, Google removed their amazing API, so...
		/*
		// Get Google API result
		$str = curl_get_contents("https://www.google.com/ig/calculator?q=" . urlencode(implode(" ", $params)));
		//file_put_contents("json.log", $str . "\n", FILE_APPEND);

		// Google, how do you suck so much at standards?
		$str = str_replace("\xA0", ",", $str);

		//echo $str;
		$result = json_decode_loose($str);
		print_r($result);

		// Fix Google's crap JSON
		//$str = str_replace(array("lhs:","rhs:","error:","icc:"),array('"lhs":','"rhs":','"error":','"icc":'),$str);
		//$result = json_decode($str);

		if(!empty($result['rhs'])) {
			$conn->message($event['from'], $result['lhs'] . ' = ' . $result['rhs'], $event['type']);
		} elseif(!empty($result['error'])) {
			$conn->message($event['from'], 'Error: ' . $result['error'], $event['type']);
		} else {
			print_r($result);
			echo $str;
			$conn->message($event['from'], "API Error", $event['type']);
		}
		*/
	} else {
		$conn->message($event['from'], "Usage: #math <expression>", $event['type']);
	}
}
?>
