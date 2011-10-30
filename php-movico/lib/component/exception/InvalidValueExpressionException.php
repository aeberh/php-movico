<?php
class InvalidValueExpressionException extends Exception {
	
	public function __construct($expression, $reason) {
		$this->message = "Value expression '$expression' is invalid: $reason";
	}
	
}
?>