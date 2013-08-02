<?php
class LatexValue {
	
	private $value;

	function __construct($value) {
		$this->value = $value;
	}

	function get() {
		return $this->value;
	}

}