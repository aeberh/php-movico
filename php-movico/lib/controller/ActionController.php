<?
class ActionController {
	
	public function perform($post, $files) {
		$view = Singleton::create("Settings")->getDefaultView();
		$this->updateModel($post, $files);
		
		$action = RequestUtil::get("ACTION");
		if(!is_null($action)) {
			$rowIndex = RequestUtil::get(DataTable::DATATABLE_ROW);
			$postView = RequestUtil::get("VIEW");
			$view = $this->executeAction($action, $rowIndex, $postView);
		}
		return $view;
	}
	
	private function executeAction($action, $rowIndex, $postView) {
		if(!StringUtil::startsWith($action, "#")) {
			return $action;
		}
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

	private function updateModel($post, $files) {
		$beanClass = "";
		foreach($post as $key=>$val) {
			if(StringUtil::startsWith($key, "#")) {
				list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($key, true);
				ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $val);
			}
		}
		foreach($files as $key=>$fileArray) {
			$file = new UploadedFile($fileArray);
			list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($key, true);
			ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $file);
		}
	}
	
}
?>