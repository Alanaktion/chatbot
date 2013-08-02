<?php
class NodeInteger {

	private $value;

	function __construct($value) {
		$this->value = $value;
	}

	function get() {
		return (int) $this->value;
	}

}