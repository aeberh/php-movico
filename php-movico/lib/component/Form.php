<?
class Form extends Component {
	
	public function render($index=null) {
		$result = "<form method=\"post\" action=\"index.php\">";
		$result .= $this->renderChildren();
		$result .= "<input type=\"hidden\" name=\"ACTION\"/>";
		$result .= "<input type=\"hidden\" name=\"VIEW\" value=\"".$this->getViewId()."\"/>";
		return $result."</form>";
	}
	
	private function getViewId() {
		return $this->getFirstAncestorOfType("View")->getPage();
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid");
	}
		
}
?>