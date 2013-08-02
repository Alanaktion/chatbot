<?php
class NodeFloat {

	private $value;

	function __construct($value) {
		$this->value = $value;
	}

	function get() {
		return (float) $this->value;
	}
	
}