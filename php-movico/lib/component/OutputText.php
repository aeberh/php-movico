<?
class OutputText extends Component {
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}

	public function render($row=null) {
		return "<span>".$this->getConvertedValue($this->value, $row)."</span>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "ColHeader");
	}
	
}
?>
