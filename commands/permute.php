<?php

if (!function_exists("permute")) {
	function permute($str) {
		// If we only have a single character, return it
		if (strlen($str) < 2) {
			return array($str);
		}
		$permutations = array();
		// Copy the string except for the first character
		$tail = substr($str, 1);
		// Loop through the permutations of the substring created above
		foreach (permute($tail) as $permutation) {
			// Get the length of the current permutation
			$length = strlen($permutation);
			// Loop through the permutation and insert the first character of the original string between the two parts and store it in the result array
			for ($i = 0; $i <= $length; $i++) {
				$permutations[] = substr($permutation, 0, $i) . $str[0] . substr($permutation, $i);
			}
		}
		return array_unique($permutations);
	}
	function factorial($in) {
		// 0! = 1! = 1
		$out = 1;
		// Only if $in is >= 2
		for ($i = 2; $i <= $in; $i++) {
			$out *= $i;
		}
		return $out;
	}
}

$commands['permute'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ", $params);
		if (strlen($param_str) > 6) {
			$n = factorial(strlen($param_str));
			// Start with a Googol and work down
			if($n>pow(10,100))
				$str_count = round(($n/pow(10,100)),1).' googol';
			// I'll add more later
			elseif($n>pow(1000,32))
				$str_count = round(($n/pow(1000,32)),1).' untrigintillion';
			elseif($n>pow(1000,31))
				$str_count = round(($n/pow(1000,31)),1).' trigintillion';
			elseif($n>pow(1000,30))
				$str_count = round(($n/pow(1000,30)),1).' novemvigintillion';
			elseif($n>pow(1000,29))
				$str_count = round(($n/pow(1000,29)),1).' octovigintillion';
			elseif($n>pow(1000,28))
				$str_count = round(($n/pow(1000,28)),1).' septenvigintillion';
			elseif($n>pow(1000,27))
				$str_count = round(($n/pow(1000,27)),1).' sexvigintillion';
			elseif($n>pow(1000,26))
				$str_count = round(($n/pow(1000,26)),1).' quinvigintillion';
			elseif($n>pow(1000,25))
				$str_count = round(($n/pow(1000,25)),1).' quattuorvigintillion';
			elseif($n>pow(1000,24))
				$str_count = round(($n/pow(1000,24)),1).' trevigintillion';
			elseif($n>pow(1000,23))
				$str_count = round(($n/pow(1000,23)),1).' duovigintillion';
			elseif($n>pow(1000,22))
				$str_count = round(($n/pow(1000,22)),1).' unvigintillion';
			elseif($n>pow(1000,21))
				$str_count = round(($n/pow(1000,21)),1).' vigintillion';
			elseif($n>pow(1000,20))
				$str_count = round(($n/pow(1000,20)),1).' novemdecillion';
			elseif($n>pow(1000,19))
				$str_count = round(($n/pow(1000,19)),1).' octodecillion';
			elseif($n>pow(1000,18))
				$str_count = round(($n/pow(1000,18)),1).' septendecillion';
			elseif($n>pow(1000,17))
				$str_count = round(($n/pow(1000,17)),1).' sexdecillion';
			elseif($n>pow(1000,16))
				$str_count = round(($n/pow(1000,16)),1).' quindecillion';
			elseif($n>pow(1000,15))
				$str_count = round(($n/pow(1000,15)),1).' quattuordecillion';
			elseif($n>pow(1000,14))
				$str_count = round(($n/pow(1000,14)),1).' tredecillion';
			elseif($n>pow(1000,13))
				$str_count = round(($n/pow(1000,13)),1).' duodecillion';
			elseif($n>pow(1000,12))
				$str_count = round(($n/pow(1000,12)),1).' undecillion';
			elseif($n>pow(1000,11))
				$str_count = round(($n/pow(1000,11)),1).' decillion';
			elseif($n>pow(1000,10))
				$str_count = round(($n/pow(1000,10)),1).' nonillion';
			elseif($n>pow(1000,9))
				$str_count = round(($n/pow(1000,9)),1).' octillion';
			elseif($n>pow(1000,8))
				$str_count = round(($n/pow(1000,8)),1).' septillion';
			elseif($n>pow(1000,7))
				$str_count = round(($n/pow(1000,7)),1).' sextillion';
			elseif($n>pow(1000,6))
				$str_count = round(($n/pow(1000,6)),1).' quintillion';
			elseif($n>pow(1000,5))
				$str_count = round(($n/pow(1000,5)),1).' quadrillion';
			elseif($n>pow(1000,4))
				$str_count = round(($n/pow(1000,4)),1).' trillion';
			elseif($n>pow(1000,3))
				$str_count = round(($n/pow(1000,3)),1).' billion';
			elseif($n>1000000)
				$str_count = round(($n/1000000),1).' million';
			elseif($n>1000)
				//$str_count = round(($n/1000),1).' thousand';
				$str_count = number_format($n);

			$conn->message($pl['from'], "That word has " . $str_count . " permutations. That's a lot.", $pl['type']);
		} else {
			$conn->message($pl['from'], implode(", ", permute($param_str)), $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #permute <word>", $pl['type']);
	}
}
?>
