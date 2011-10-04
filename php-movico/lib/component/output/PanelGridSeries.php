<?php
class PanelGridSeries extends PanelSeries {
	
	private $columns;
	
	public function setColumns($columns) {
		$this->columns = $columns;
	}

	public function doRender($index=null) {
		$nbRows = count($this->getRows());
		$result = "<div><table class=\"panelGridSeries\" id=\"".$this->id."\"><tr>";
		for($i=0; $i<$nbRows; $i++) {
			$result .= "<td>";
			foreach($this->getChildren() as $child) {
				$result .= $child->render($i);
			}
			$result .= "</td>";
			if(($i+1)%$this->getColumns() === 0) {
				$result .= "</tr><tr>";
			}
		}
		$result .= "</tr></table>";
		if($this->hasAnchestorOfType("Form")) {
			$result .= "<input type=\"hidden\" name=\"".MovicoRequest::ROW_INDEX."\"/>";
		}
		return $result."</div>";
	}
	
	public function getColumns() {
		return $this->getConvertedValue($this->columns);
	}

}
?>