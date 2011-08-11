<?php
class ValueExpression extends BindingExpression {
	
	public function isSingleExpression() {
		return $this->expression->startsWith("#");
	}
	
}
?>