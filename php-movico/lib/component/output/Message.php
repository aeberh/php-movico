<?php
class Message extends Component {
	
	public function doRender($rowIndex=null) {
		if(!MessageUtil::hasMessage()) {
			return "";
		}
		$msgObj = MessageUtil::getMessage();
		$sev = $msgObj->getSeverity();
		$msg = $msgObj->getMessage();
		return "<div class=\"msg $sev\">$msg</div>";
	}
	
}
?>