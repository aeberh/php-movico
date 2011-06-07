<?
class CommandLink extends AbstractCommand {
	
	public function doRender($index=null) {
		$formId = $this->getFirstAncestorOfType("Form")->getId();
		$onclick = "var formEl=document.getElementById('$formId');formEl.ACTION.value='".$this->action."';";
		if($this->isLinkEnabled()) {
			$onclick .= "formEl.action='{$this->getHref()}';";
		}
		if($this->hasAnchestorOfType("DataSeries") && $this->hasAnchestorOfType("Form")) {
			$onclick .= "formEl.".DataTable::DATATABLE_ROW.".value='$index';";
		}
		$onclick .= "$('form#".$formId."').submit();";
		if(!empty($this->popup)) {
			$msg = $this->getConvertedValue($this->popup, $index);
			$onclick = "if(confirm('$msg')){".$onclick."}else{return false;}";
		}
		return "<a href=\"{$this->getHref()}\" onclick=\"$onclick\">".$this->getConvertedValue($this->value, $index)."</a>";
	}

}
?>