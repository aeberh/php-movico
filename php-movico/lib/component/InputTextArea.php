<?
class InputTextArea extends Component {
	
	private $value;

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function render() {
		$name = $this->value;
		$val = BeanUtil::getProperty($name);
		return "<textarea id=\"".$this->id."\" name=\"$name\">$val</textarea>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid");
	}
	
}
?>