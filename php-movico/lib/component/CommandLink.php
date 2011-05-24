<?
class CommandLink extends AbstractCommand {
	
	public function doRender($index=null) {
		$formId = $this->getFirstAncestorOfType("Form")->getId();
		$onclick = "var formEl=document.getElementById('$formId');formEl.ACTION.value='".$this->action."';";
		if($this->link) {
			$onclick .= "formEl.action='#{$this->getHash()}';";
		}
		if($this->hasAnchestorOfType("DataSeries") && $this->hasAnchestorOfType("Form")) {
			$onclick .= "formEl.".DataTable::DATATABLE_ROW.".value='$index';";
		}
		$onclick .= "$('form#".$formId."').submit();";
		if(!empty($this->popup)) {
			$msg = $this->getConvertedValue($this->popup, $index);
			$onclick = "if(confirm('$msg')){".$onclick."}else{return false;}";
		}
		return "<a href=\"#{$this->getHash()}\" onclick=\"$onclick\">".$this->getConvertedValue($this->value, $index)."</a>";
	}

}
?>