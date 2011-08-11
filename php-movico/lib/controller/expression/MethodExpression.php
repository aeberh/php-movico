<?php
class MethodExpression extends BindingExpression {

	public function execute($actionParams) {
		$action = $this->expression;
		list($beanClass, $methodName) = BeanUtil::getBeanAndProperties($action);
		$beanInstance = BeanLocator::get($beanClass);
		return ReflectionUtil::callMethod($beanInstance, $methodName, $actionParams);
	}
	
	public function isConstantValue() {
		return !$this->expression->startsWith("#");
	}
	
}
?>