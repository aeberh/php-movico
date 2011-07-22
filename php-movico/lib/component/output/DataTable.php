<?
class DataTable extends DataSeries {
	
	const DATATABLE_ROW = "DATATABLE_ROW";
	
	/*
	 * <dataTable value="#{Bean.rows}" var="row" rows="10"
	 */
	
	public function doRender($index=null) {
		$cols = $this->getChildrenOfType("Column");
		$result = "<div id=\"".rand(100000, 999999)."\"><table id=\"".$this->id."\" class=\"dataTable\" cellspacing=\"0\" cellpadding=\"0\">";
		$result .= $this->renderHeader($cols);
		$result .= $this->renderRows($cols);
		$result .= "</table>";
		if($this->isPagination()) {
			$result .= $this->renderPagination();
		}
		if($this->hasAnchestorOfType("Form")) {
			$result .= "<input type=\"hidden\" name=\"".self::DATATABLE_ROW."\"/>";
		}
		return "$result</div>";
	}
	
	private function renderPagination() {
		$nbPages = count($this->getRows())/$this->rows+1;
		if($nbPages == 1) {
			return "";
		}
		$result = "<p currentPage=\"1\" nbPages=\"$nbPages\" class=\"dataTablePagination\">";
		$result .= "<a href=\"#\" class=\"prev\">&lt;</a>&nbsp;";
		for($i=1; $i<=$nbPages; $i++) {
			$result .= "<a href=\"#\" class=\"pg\">$i</a>&nbsp;";
		}
		$result .= "<a href=\"#\" class=\"next\">&gt;</a>";
		return $result."</p>";
	}

	private function renderHeader($cols) {
		$numHeaders = 0;
		$result = "<tr>";
		foreach($cols as $col) {
			$result .= "<th>";
			$headers = $col->getChildrenOfType("ColHeader");
			if(!empty($headers)) {
				$header = $headers[0];
				$children = $header->getChildren();
				if(!empty($children)) {
					$numHeaders++;
					$result .= $col->renderChildren(array("ColHeader"));
				}
			}
			$result.="</th>";
		}
		return $numHeaders == 0 ? "" : $result."</tr>";
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