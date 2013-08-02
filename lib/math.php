<?php
require_once "math_parse.php";

require_once "calculate/node_float.php";
require_once "calculate/node_integer.php";
require_once "calculate/node_operation.php";
require_once "calculate/operator_exponent.php";
require_once "calculate/operator_multiply.php";
require_once "calculate/operator_divide.php";
require_once "calculate/operator_add.php";
require_once "calculate/operator_subtract.php";

function math_tree_on_wrapper($val) {
	return $val[0];
}

function math_tree_on_stub($val) {
	return null;
}

function math_calculate_tree_on_float($val) {
	return new NodeFloat($val);
}

function math_calculate_tree_on_integer($val) {
	return new NodeInteger($val);
}

function math_calculate_tree_on_exponent($val) {
	return new OperatorExponent();
}

function math_calculate_tree_on_multiply($val) {
	return new OperatorMultiply();
}

function math_calculate_tree_on_divide($val) {
	return new OperatorDivide();
}

function math_calculate_tree_on_add($val) {
	return new OperatorAdd();
}

function math_calculate_tree_on_subtract($val) {
	return new OperatorSubtract();
}

function math_calculate_tree_on_operation($val) {
	return new NodeOperation($val[0], $val[1], $val[2]);
}

function math_calculate_tree_on_paren($val) {
	return $val[1];
}

function math_get_types() {
	return array(
		"integer" => array("n"),
		"float" => array("n"),
		"multiply" => array("m"),
		"divide" => array("m"),
		"add" => array("a"),
		"subtract" => array("a"),
		"op" => array("o"),
		"p" => array("o"),
		"n" => array("o"),
		"o" => array(),
		"m" => array(),
		"a" => array(),
		"exponent" => array(),
		"openparen" => array(),
		"closeparen" => array()
	);
}

function math_get_resolved_types() {
	return parse_resolve_types(math_get_types());
}

function math_get_tokens() {
	return array(
		array('(\d*\.\d+)', "float"),
		array('(\d+)', "integer"),
		array('(\^)', "exponent"),
		array('(\*)', "multiply"),
		array('(\/)', "divide"),
		array('(\+)', "add"),
		array('(\-)', "subtract"),
		array('\(', "openparen"),
		array('\)', "closeparen")
	);
}

function math_get_grammar() {
	return array(
		array("p", array("openparen", "o", "closeparen")),
		array("op", array("o", "exponent", "o")),
		array("op", array("o", "m", "o")),
		array("op", array("o", "a", "o"))
	);
}

function math_parse_tokens($expr) {
	$tokens = parse_tokens($expr, math_get_tokens(), math_get_resolved_types());

	if(!count($tokens))
		throw new Exception("Math expression invalid! No tokens found!");

	return $tokens;
}

function math_parse_grammar($tokens) {
	$tree = parse_grammar($tokens, math_get_grammar(), math_get_resolved_types());

	if(!in_array("o", $tree[0]))
		throw new Exception("Math expression invalid! Root should be operand!");

	return $tree;
}

function math_calculate($expr) {

	if(!strlen(trim($expr))) 
		return null;

	$types = math_get_resolved_types();

	$result = parse_traverse(math_parse_grammar(math_parse_tokens($expr)), array(
		"float" => "math_calculate_tree_on_float",
		"integer" => "math_calculate_tree_on_integer",
		"exponent" => "math_calculate_tree_on_exponent",
		"multiply" => "math_calculate_tree_on_multiply",
		"divide" => "math_calculate_tree_on_divide",
		"add" => "math_calculate_tree_on_add",
		"subtract" => "math_calculate_tree_on_subtract",
		"op" => "math_calculate_tree_on_operation",
		"o" => "math_tree_on_wrapper",
		"m" => "math_tree_on_wrapper",
		"a" => "math_tree_on_wrapper",
		"n" => "math_tree_on_wrapper",
		"p" => "math_calculate_tree_on_paren",
		"openparen" => "math_tree_on_stub",
		"closeparen" => "math_tree_on_stub"
	));

	if($result == null)
		throw new Exception("Math expression invalid!");

	return $result->get();
}

require_once "latex/latex_value.php";
require_once "latex/latex_operation.php";
require_once "latex/latex_exponent.php";
require_once "latex/latex_multiply.php";
require_once "latex/latex_divide.php";
require_once "latex/latex_add.php";
require_once "latex/latex_subtract.php";
require_once "latex/latex_parenthesis.php";

function math_latex_tree_on_value($val) {
	return new LatexValue($val);
}

function math_latex_tree_on_exponent($val) {
	return new LatexExponent();
}

function math_latex_tree_on_multiply($val) {
	return new LatexMultiply();
}

function math_latex_tree_on_divide($val) {
	return new LatexDivide();
}

function math_latex_tree_on_add($val) {
	return new LatexAdd();
}

function math_latex_tree_on_subtract($val) {
	return new LatexSubtract();
}

function math_latex_tree_on_operation($val) {
	return new LatexOperation($val[0], $val[1], $val[2]);
}

function math_latex_tree_on_paren($val) {
	return new LatexParenthesis($val[1]);
}

function math_latex($expr) {

	if(!strlen(trim($expr))) 
		return "";

	$result = parse_traverse(math_parse_grammar(math_parse_tokens($expr)), array(
		"float" => "math_latex_tree_on_value",
		"integer" => "math_latex_tree_on_value",
		"exponent" => "math_latex_tree_on_exponent",
		"multiply" => "math_latex_tree_on_multiply",
		"divide" => "math_latex_tree_on_divide",
		"add" => "math_latex_tree_on_add",
		"subtract" => "math_latex_tree_on_subtract",
		"op" => "math_latex_tree_on_operation",
		"o" => "math_tree_on_wrapper",
		"m" => "math_tree_on_wrapper",
		"a" => "math_tree_on_wrapper",
		"n" => "math_tree_on_wrapper",
		"p" => "math_latex_tree_on_paren",
		"openparen" => "math_tree_on_stub",
		"closeparen" => "math_tree_on_stub"
	));

	if($result == null)
		throw new Exception("Math expression invalid!");

	return $result->get();
}