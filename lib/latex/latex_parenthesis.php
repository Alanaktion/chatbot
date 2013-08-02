<?php
class LatexParenthesis {
	
	private $operand;

	function __construct($operand) {
		$this->operand = $operand;
	}

	function get() {
		return "({$this->operand->get()})";
	}

}