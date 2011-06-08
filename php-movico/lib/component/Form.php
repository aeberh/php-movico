<?
class Form extends Component {
	
	public function doRender($index=null) {
		$isFileUpload = $this->hasDescendantOfType("FileUpload");
		$enctype = $isFileUpload ? "multipart/form-data" : "application/x-www-form-urlencoded";
		$target = $isFileUpload ? "fileUpload".$this->id : "_self";
		$action = $isFileUpload ? $_SERVER["PHP_SELF"]."?upload=1" : $_SERVER["PHP_SELF"];
		$result = "<form enctype=\"$enctype\" name=\"form".$this->id."\" id=\"".$this->id."\" method=\"post\" action=\"$action\" target=\"$target\">";
		$result .= $this->renderChildren();
		$result .= "<input type=\"hidden\" name=\"ACTION\"/>";
		$result .= "<input type=\"hidden\" name=\"VIEW\" value=\"".$this->getViewId()."\"/>";
		$result .= "</form>";
		if($isFileUpload) {
			$result .= "<iframe name=\"fileUpload".$this->id."\" style=\"display:none;\" src=\"about:blank\"></iframe>";
		}
		return $result;
	}
	
	private function getViewId() {
		return $this->getFirstAncestorOfType("View")->getPage();
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid", "PanelGroup", "div");
	}
		
}
?>