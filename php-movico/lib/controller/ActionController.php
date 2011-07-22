<?
class ActionController {
	
	public function perform($post, $files) {
		$view = Singleton::create("Settings")->getDefaultView();
		if(isset($post["REDIRECT"])) {
			$view = $post["REDIRECT"];
		}
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
		/* obsolete now that we work with params
		if(!is_null($rowIndex)) {
			ReflectionUtil::callNestedSetter($beanInstance, "selectedRowIndex", $rowIndex);
		}
		*/
		$argValues = isset($_POST["ACTION_PARAM"][$action]) ? $_POST["ACTION_PARAM"][$action] : array();
		$view = ReflectionUtil::callMethod($beanInstance, $methodName, $argValues);
		if(is_null($view)) {
			$view = $postView;
		}
		return $view;
	}

	private function updateModel($post, $files) {
		$beanClass = "";
		foreach($post as $key=>$val) {
			if(StringUtil::startsWith($key, "#")) {
				$type = empty($post["_type_".$key]) ? "Null" : $post["_type_".$key];
				$objValue = Singleton::create("Domain".$type."Converter")->fromViewToDom($val);
				list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($key, true);
				ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $objValue);
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