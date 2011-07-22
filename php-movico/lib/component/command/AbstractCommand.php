<?
abstract class AbstractCommand extends Component {
	
	protected $action;
	protected $value;
	protected $popup;
	protected $link;
	
	public function setLink($link) {
		$this->link = $link;
	}
	
	public function isLinkEnabled() {
		return $this->link === "true";
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
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "li", "p", "div", "h1", "h2", "h3", "PanelGridSeries");
	}
	
	public function getAction() {
		return $this->action;
	}
	
	protected function renderParams($index) {
		return $this->renderChildren(array("Param"), array(), $index);
	}
	
	protected function getHref() {
		if(!String::create($this->action)->trim()->startsWith("$") && $this->isLinkEnabled()) {
			return "#".$this->action;
		}
		return "#";
	}
	
}
?>