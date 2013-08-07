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
			if($n>1000000000000000)
				$str_count = round(($n/1000000000000000),1).' quadrillion';
			elseif($n>1000000000000)
				$str_count = round(($n/1000000000000),1).' trillion';
			elseif($n>1000000000)
				$str_count = round(($n/1000000000),1).' billion';
			elseif($n>1000000)
				$str_count = round(($n/1000000),1).' million';
			elseif($n>1000)
				$str_count = round(($n/1000),1).' thousand';
			else
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
