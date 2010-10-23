<?
abstract class AbstractInput extends Component {
	
	private $value;

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function render($index=null) {
		$name = $this->value;
		$val = $this->getConvertedValue($this->value);
		$type = $this->getType();
		return "<input id=\"".$this->id."\" type=\"$type\" name=\"$name\" value=\"$val\"/>";
	}
	
	public abstract function getType();
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column");
	}
	
}
?>