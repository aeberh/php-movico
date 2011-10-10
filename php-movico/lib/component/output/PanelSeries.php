<?php
class PanelSeries extends DataSeries {
	
	public function doRender($index=null) {
		$nbRows = count($this->getRows());
		$result = "<div id=\"".$this->id."\">";
		for($i=0; $i<$nbRows; $i++) {
			//$result .= "<div>";
			foreach($this->getChildren() as $child) {
				$result .= $child->render($i);
			}
			//$result .= "</div>";
		}
		return $result."</div>";
	}
	
	public function getRows() {
		return $this->getConvertedValue($this->value);
	}
	
}
?>