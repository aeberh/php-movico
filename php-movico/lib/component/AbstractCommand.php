<?
abstract class AbstractCommand extends Component {
	
	protected $action;
	protected $value;
	protected $popup;
	protected $link;
	
	public function setLink($link) {
		$this->link = $link;
	}
	
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
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "li", "p", "div", "PanelGridSeries");
	}
	
	protected function getHash() {
		return String::create($this->action)->startsWith("$") ? "" : $this->action;
	}
	
}
?>