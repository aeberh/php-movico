<?
class PanelSeries extends DataSeries {
	
	public function doRender($index=null) {
		$nbRows = count($this->getRows());
		$result = "";
		for($i=0; $i<$nbRows; $i++) {
			$result .= "<div>";
			foreach($this->getChildren() as $child) {
				$result .= $child->render($i);
			}
			$result .= "</div>";
		}
		return $result;
	}
	
	public function getRows() {
		list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($this->value);
		$beanObj = BeanLocator::get($beanClass);
		return ReflectionUtil::callNestedGetter($beanObj, $nestedProperty);
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid", "Form", "PanelGroup", "div", "PanelSeries");
	}
	
}
?>