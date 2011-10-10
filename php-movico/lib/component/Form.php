<?php
class Form extends Component {
	
	public function doRender($index=null) {
		$isFileUpload = $this->hasDescendantOfType("FileUpload");
		$enctype = $isFileUpload ? "multipart/form-data" : "application/x-www-form-urlencoded";
		$target = $isFileUpload ? "fileUpload".$this->id : "_self";
		$context = parent::$settings->getContextPath()."/index.php";
		$action = $isFileUpload ? "$context?upload=1" : $context;
		$result = "<form".$this->getClassStr()." enctype=\"$enctype\" name=\"form".$this->id."\" id=\"".$this->id."\" method=\"post\" action=\"$action\" target=\"$target\">";
		$result .= $this->renderChildren();
		$result .= "<input type=\"hidden\" name=\"".MovicoRequest::ACTION."\"/>";
		$result .= "<input type=\"hidden\" name=\"".MovicoRequest::PREV_URL."\" value=\"".$this->getViewId()."\"/>";
		$result .= "</form>";
		if($isFileUpload) {
			$result .= "<iframe name=\"fileUpload".$this->id."\" style=\"display:none;\" src=\"about:blank\"></iframe>";
		}
		return $result;
	}
	
	private function getViewId() {
		return $this->getFirstAncestorOfType("View")->getUrl();
	}
	
}
?>