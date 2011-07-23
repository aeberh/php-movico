<?
class OutputText extends Component {
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}

	public function doRender($row=null) {
		return "<span class=\"".$this->class."\">".$this->getConvertedValue($this->value, $row)."</span>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "ColHeader", "PanelGroup", "PanelSeries", "PanelGridSeries", "div", "p", "h1", "h2", "h3", "h4", "h5", "h6");
	}
	
}
?>
