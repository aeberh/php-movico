<?
class DataTable extends Component {
	
	private $value;
	private $var;
	
	const DATATABLE_ROW = "DATATABLE_ROW";
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setVar($var) {
		$this->var = $var;
	}
	
	public function getVar() {
		return $this->var;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function doRender($index=null) {
		$cols = $this->getChildrenOfType("Column");
		$result = "<table class=\"dataTable\" cellspacing=\"0\" cellpadding=\"0\">";
		$result .= $this->renderHeader($cols);
		$result .= $this->renderRows($cols);
		$result .= "</table>";
		if($this->hasAnchestorOfType("Form")) {
			$result .= "<input type=\"hidden\" name=\"".self::DATATABLE_ROW."\"/>";
		}
		return $result;
	}

	private function renderHeader($cols) {
		$result = "<tr>";
		foreach($cols as $col) {
			$result .= $col->renderChildren(array("ColHeader"));
		}
		return $result."</tr>";
	}
	
	public function getRows() {
		list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($this->value);
		$beanObj = BeanLocator::get($beanClass);
		return ReflectionUtil::callNestedGetter($beanObj, $nestedProperty);
	}
	
	private function renderRows($cols) {
		$rows = $this->getRows();
		$result = "";
		for($i=0; $i<count($rows); $i++) {
			$row = $rows[$i];
			$result .= "<tr>";
			foreach($cols as $col) {
				$result .= "<td>".$col->render($i)."</td>";
			}
			$result .= "</tr>";
		}
		return $result;
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid", "Form");
	}
	
}
?>