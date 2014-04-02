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

if (!function_exists("number_format_huge")) {
	function number_format_huge($n) {
		// Start with a Googol and work down
		if($n>pow(10,100))
			return round(($n/pow(10,100)),1).' googol';
		// I'll add more later
		if($n>pow(1000,32))
			return round(($n/pow(1000,32)),1).' untrigintillion';
		if($n>pow(1000,31))
			return round(($n/pow(1000,31)),1).' trigintillion';
		if($n>pow(1000,30))
			return round(($n/pow(1000,30)),1).' novemvigintillion';
		if($n>pow(1000,29))
			return round(($n/pow(1000,29)),1).' octovigintillion';
		if($n>pow(1000,28))
			return round(($n/pow(1000,28)),1).' septenvigintillion';
		if($n>pow(1000,27))
			return round(($n/pow(1000,27)),1).' sexvigintillion';
		if($n>pow(1000,26))
			return round(($n/pow(1000,26)),1).' quinvigintillion';
		if($n>pow(1000,25))
			return round(($n/pow(1000,25)),1).' quattuorvigintillion';
		if($n>pow(1000,24))
			return round(($n/pow(1000,24)),1).' trevigintillion';
		if($n>pow(1000,23))
			return round(($n/pow(1000,23)),1).' duovigintillion';
		if($n>pow(1000,22))
			return round(($n/pow(1000,22)),1).' unvigintillion';
		if($n>pow(1000,21))
			return round(($n/pow(1000,21)),1).' vigintillion';
		if($n>pow(1000,20))
			return round(($n/pow(1000,20)),1).' novemdecillion';
		if($n>pow(1000,19))
			return round(($n/pow(1000,19)),1).' octodecillion';
		if($n>pow(1000,18))
			return round(($n/pow(1000,18)),1).' septendecillion';
		if($n>pow(1000,17))
			return round(($n/pow(1000,17)),1).' sexdecillion';
		if($n>pow(1000,16))
			return round(($n/pow(1000,16)),1).' quindecillion';
		if($n>pow(1000,15))
			return round(($n/pow(1000,15)),1).' quattuordecillion';
		if($n>pow(1000,14))
			return round(($n/pow(1000,14)),1).' tredecillion';
		if($n>pow(1000,13))
			return round(($n/pow(1000,13)),1).' duodecillion';
		if($n>pow(1000,12))
			return round(($n/pow(1000,12)),1).' undecillion';
		if($n>pow(1000,11))
			return round(($n/pow(1000,11)),1).' decillion';
		if($n>pow(1000,10))
			return round(($n/pow(1000,10)),1).' nonillion';
		if($n>pow(1000,9))
			return round(($n/pow(1000,9)),1).' octillion';
		if($n>pow(1000,8))
			return round(($n/pow(1000,8)),1).' septillion';
		if($n>pow(1000,7))
			return round(($n/pow(1000,7)),1).' sextillion';
		if($n>pow(1000,6))
			return round(($n/pow(1000,6)),1).' quintillion';
		if($n>pow(1000,5))
			return round(($n/pow(1000,5)),1).' quadrillion';
		if($n>pow(1000,4))
			return round(($n/pow(1000,4)),1).' trillion';
		if($n>pow(1000,3))
			return round(($n/pow(1000,3)),1).' billion';
		if($n>1000000)
			return round(($n/1000000),1).' million';
		if($n>1000)
			return number_format($n);
	}
}

$commands['permute'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ", $params);
		if (strlen($param_str) > 6) {

			$numerator = factorial(strlen($param_str));
			$denominator = 1;

			// Check for duplicate characters
			$duplicates = array_count_values(str_split($param_str));
			foreach($duplicates as $char=>$count) {
				if($count > 1) {
					$denominator = $denominator * factorial($count);
				}
			}

			// Get final count
			$exact = $numerator / $denominator;

			$conn->message($pl['from'], "That word has an estimated " . number_format_huge($numerator) . " permutations and " . number_format_huge($exact) . " unique permutations. That's a lot.", $pl['type']);
		} else {
			$conn->message($pl['from'], implode(", ", permute($param_str)), $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #permute <word>", $pl['type']);
	}
}
?>
