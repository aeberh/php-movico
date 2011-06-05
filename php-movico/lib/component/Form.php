<?
class Form extends Component {
	
	public function doRender($index=null) {
		$isFileUpload = $this->hasDescendantOfType("FileUpload");
		$enctype = $isFileUpload ? "multipart/form-data" : "application/x-www-form-urlencoded";
		$i = rand(10000, 99999);
		$target = $isFileUpload ? "fileUpload".$i : "_self";
		$action = $isFileUpload ? "index.php?file=1" : "index.php";
		$result = "<form enctype=\"$enctype\" name=\"form".$this->id."\" id=\"".$this->id."\" method=\"post\" action=\"$action\" target=\"$target\">";
		$result .= $this->renderChildren();
		$result .= "<input type=\"hidden\" name=\"ACTION\"/>";
		$result .= "<input type=\"hidden\" name=\"VIEW\" value=\"".$this->getViewId()."\"/>";
		$result .= "</form>";
		if($isFileUpload) {
			$result .= "<iframe name=\"fileUpload.$i.\" width=\"1000\" height=\"700\" src=\"#\"></iframe>";
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