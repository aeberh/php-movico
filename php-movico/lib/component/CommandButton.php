<?
class CommandButton extends Component {
	
	private $action;
	private $value;
	
	public function setAction($action) {
		$this->action = $action;
	}

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function render($index=null) {
		return "<button type=\"submit\" onclick=\"this.form.ACTION.value='".$this->action."';\">".$this->value."</button>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column");
	}
	
}
?>