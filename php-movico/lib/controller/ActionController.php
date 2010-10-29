<?
class ActionController {
	
	public function perform($post) {
		$view = View::DEFAULT_VIEW;
		$this->updateModel($post);
		
		$action = RequestUtil::get("ACTION");
		if(!is_null($action)) {
			$rowIndex = RequestUtil::get(DataTable::DATATABLE_ROW);
			$postView = RequestUtil::get("VIEW");
			$view = $this->executeAction($action, $rowIndex, $postView);
		}
		return $view;
	}
	
	private function executeAction($action, $rowIndex, $postView) {
		list($beanClass, $methodName) = BeanUtil::getBeanAndProperties($action);
		$beanInstance = BeanLocator::get($beanClass);
		if(!is_null($rowIndex)) {
			ReflectionUtil::callNestedSetter($beanInstance, "selectedRowIndex", $rowIndex);
		}
		$view = ReflectionUtil::callMethod($beanInstance, $methodName);
		if(is_null($view)) {
			$view = $postView;
		}
		return $view;
	}

	private function updateModel($post) {
		foreach($post as $key=>$val) {
			if(StringUtil::startsWith($key, "#")) {
				list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($key, true);
				ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $val);
			}
		}
	}
	
}
?>