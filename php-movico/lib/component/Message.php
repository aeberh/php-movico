<?
class Message extends Component {
	
	public function render($rowIndex=null) {
		if(!MessageUtil::hasMessage()) {
			return "";
		}
		$msgObj = MessageUtil::getMessage();
		$sev = $msgObj->getSeverity();
		$msg = $msgObj->getMessage();
		return "<div class=\"msg $sev\">$msg</div>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "ColHeader");
	}
	
}
?>