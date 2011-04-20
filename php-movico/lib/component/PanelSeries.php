<?
class PanelSeries extends DataSeries {
	
	public function doRender($index=null) {
		$children = $this->getChildren();
		$rows = $this->getRows();
		$result = "";
		for($i=0; $i<count($rows); $i++) {
			$result .= "<div>".$rows[$i]->render($i)."</div>";
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