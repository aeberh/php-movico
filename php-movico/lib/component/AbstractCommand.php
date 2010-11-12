<?
abstract class AbstractCommand extends Component {
	
	protected $action;
	protected $value;
	protected $popup;
	
	public function setAction($action) {
		$this->action = $action;
	}

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setPopup($popup) {
		$this->popup = $popup;
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "li", "p");
	}
	
}
?>