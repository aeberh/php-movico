<?
class OutputLabel extends Component {
	
	private $value;
	private $for;
	
	public function render() {
		return "<label for=\"".$this->for."\">".$this->value."</label>";
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function getFor() {
		return $this->for;
	}
	
	public function setFor($for) {
		$this->for = $for;
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid");
	}
	
}
?>