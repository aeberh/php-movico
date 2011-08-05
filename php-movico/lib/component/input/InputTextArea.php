<?
class InputTextArea extends Component {
	
	private $value;

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function doRender($index=null) {
		$name = $this->value;
		$val = $this->getConvertedValue($name, $index);
		return "<textarea id=\"".$this->id."\" class=\"".$this->class."\" name=\"$name\">$val</textarea>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "p");
	}
	
}
?>