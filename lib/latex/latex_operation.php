<?php
class LatexOperation {
	
	private $left;
	private $right;
	private $formatter;

	function __construct($left, $formatter, $right) {
		$this->left = $left;
		$this->right = $right;
		$this->formatter = $formatter;
	}

	function get() {
		return $this->formatter->format($this->left->get(), $this->right->get());
	}

}