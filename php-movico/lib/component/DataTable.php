<?
class DataTable extends DataSeries {
	
	const DATATABLE_ROW = "DATATABLE_ROW";
	const DATATABLE_FROM = "DATATABLE_FROM";
	
	/*
	 * <dataTable value="#{Bean.rows}" var="row" rows="10"
	 */
	
	public function doRender($index=null) {
		$cols = $this->getChildrenOfType("Column");
		$result = "<table id=\"".$this->id."\" class=\"dataTable\" cellspacing=\"0\" cellpadding=\"0\">";
		$result .= $this->renderHeader($cols);
		$result .= $this->renderRows($cols);
		$result .= "</table>";
		if($this->isPagination()) {
			$nbPages = count($this->getRows())/$this->rows+1;
			$result .= "<p class=\"dataTablePagination\">";
			for($i=1; $i<=$nbPages; $i++) {
				$result .= "<a href=\"#\">$i</a>&nbsp;";
			}
			$result .= "</p>";
		}
		if($this->hasAnchestorOfType("Form")) {
			$result .= "<input type=\"hidden\" name=\"".self::DATATABLE_ROW."\"/>";
		}
		return $result;
	}

	private function renderHeader($cols) {
		$result = "<tr>";
		foreach($cols as $col) {
			$result .= "<th>".$col->renderChildren(array("ColHeader"))."</th>";
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
			$page = isset($this->rows) ? floor($i/$this->rows)+1 : 1;
			$row = $rows[$i];
			$result .= "<tr class=\"page p$page\">";
			foreach($cols as $col) {
				$result .= "<td>".$col->render($i)."</td>";
			}
			$result .= "</tr>";
		}
		return $result;
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid", "Form", "PanelGroup", "div");
	}
	
}
?>