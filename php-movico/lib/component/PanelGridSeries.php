<?
class PanelGridSeries extends PanelSeries {
	
	private $columns;
	
	public function setColumns($columns) {
		$this->columns = $columns;
	}

	public function doRender($index=null) {
		$nbRows = count($this->getRows());
		$result = "<table class=\"panelGridSeries\" id=\"".$this->id."\"><tr>";
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
		return $result."</tr></table>";
	}
	
	public function getColumns() {
		return $this->getConvertedValue($this->columns);
	}

}
?>