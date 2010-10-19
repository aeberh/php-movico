<?
class OutputText extends Component {
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function render() {
		$val = BeanUtil::getProperty($this->value);
		return "<span>$val</span>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid");
	}
	
}
?>
