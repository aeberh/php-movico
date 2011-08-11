<?
class CommandLink extends AbstractCommand {
	
	public function doRender($index=null) {
		$formId = $this->getFirstAncestorOfType("Form")->getId();
		$onclick = "var formEl=document.getElementById('$formId');formEl.".MovicoRequest::ACTION.".value='".$this->action."';";
		if($this->isLinkEnabled()) {
			$onclick .= "formEl.action='{$this->getHref()}';";
		}
		if($this->hasAnchestorOfType("DataSeries") && $this->hasAnchestorOfType("Form")) {
			$action = str_replace(array("#", "{", "}", "."), array("\\\\#", "\\\\{", "\\\\}", "\\\\."), $this->action);
			$onclick .= "formEl.".MovicoRequest::ROW_INDEX.".value='$index'; jQuery('input[name^=".MovicoRequest::ACTION_PARAM."\\\\[{$action}_{$index}\\\\]]').removeAttr('disabled');";
		}
		$onclick .= "$('form#".$formId."').submit();";
		if(!empty($this->popup)) {
			$msg = $this->getConvertedValue($this->popup, $index);
			$onclick = "if(confirm('$msg')){".$onclick."}else{return false;}";
		}
		return "<a href=\"#\" onclick=\"$onclick return false;\">".$this->getConvertedValue($this->value, $index)."</a>".$this->renderParams($index);
	}
	
	// href=\"{$this->getHref()}\"

}
?>