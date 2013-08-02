<?php
class NodeOperation {

	private $left;
	private $right;
	private $operator;

	function __construct($left, $operator, $right) {
		$this->left = $left;
		$this->right = $right;
		$this->operator = $operator;
	}

	function get() {
		return $this->operator->apply($this->left->get(), $this->right->get());
	}

}