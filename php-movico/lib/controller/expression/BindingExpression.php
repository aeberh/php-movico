<?php
abstract class BindingExpression {
	
	protected $expression;
	
	public function __construct($expression) {
		$this->expression = String::create($expression);
	}
	
	
	
}
?>