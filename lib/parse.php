<?php
function parse_resolve_type($type, $types) {
	$resolved = array($type);

	if(!isset($types[$type]))
		throw new Exception("Types error! Type '$type' is not defined!");

	foreach($types[$type] as $parent) {
		$resolved = array_merge($resolved, parse_resolve_type($parent, $types));
	}

	return $resolved;
}

function parse_resolve_types($types) {
	$resolved = array();
	foreach($types as $type => $parent) {
		$resolved[$type] = parse_resolve_type($type, $types);
	}
	return $resolved;
}

function parse_tokens($expr, $patterns, $types) {
	$tokens = array();
	$rem = $expr;
	while(strlen($rem) > 0) {
		$rem = trim($rem);
		$matches = array();
		$token = null;

		foreach($patterns as $pattern) {
			if(preg_match("/^({$pattern[0]})/", $rem, $matches)) {
				$token = array($types[$pattern[1]], $matches[0]);
				break;
			}
		}

		if(!count($matches)) 
			throw new Exception("Lexical error! Could not tokenize '$rem'!");

		$tokens[] = $token;
		$rem = substr($rem, strlen($matches[0]));
	}
	return $tokens;
}

function parse_grammar($tokens, $grammar, $types) {

	$updated = true;

	while($updated != false) {
		$updated = false;

		foreach($grammar as $expr) {
			$pattern = $expr[1];

			for($i = 0; $i <= count($tokens) - count($pattern); ++$i) {
				$match = false;

				for($j = 0; $j < count($pattern); ++$j) {
					$token = $tokens[$i + $j];
					$other = $pattern[$j];
					$match = in_array($other, $token[0]);
					if(!$match) break;
				}

				if($match) {
					$updated = true;
					$children = array_splice($tokens, $i, count($pattern));
					$updated = array($types[$expr[0]], $children);
					array_splice($tokens, $i, 0, array($updated));
					--$i;
				}
			}
			
		}
	}

	if(!count($tokens) == 1)
		throw new Exception("Syntax error! Invalid grammar!");

	return $tokens[0];
}

function parse_traverse($tree, $funcs) {

	$args = array();
	$token = $tree[0];
	$value = $tree[1];

	if(is_array($value)) {
		foreach($value as $child) {
			$args[] = parse_traverse($child, $funcs);
		}
		$value = $args;
	}

	if(!isset($funcs[$token[0]]))
		throw new Exception("Parser error! Token parser not defined for '$token'!");

	return call_user_func($funcs[$token[0]], $value);
}