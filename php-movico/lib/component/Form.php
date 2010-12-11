<?
class Form extends Component {
	
	public function doRender($index=null) {
		$result = "<form enctype=\"multipart/form-data\" name=\"form".$this->id."\" id=\"".$this->id."\" method=\"post\" action=\"index.php\">";
		$result .= $this->renderChildren();
		$result .= "<input type=\"hidden\" name=\"ACTION\"/>";
		$result .= "<input type=\"hidden\" name=\"VIEW\" value=\"".$this->getViewId()."\"/>";
		return $result."</form>";
	}
	
	private function getViewId() {
		return $this->getFirstAncestorOfType("View")->getPage();
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid", "PanelGroup", "div");
	}
		
}
?>