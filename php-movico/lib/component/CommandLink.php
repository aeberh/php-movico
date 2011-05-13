<?
class CommandLink extends AbstractCommand {
	
	public function doRender($index=null) {
		$formId = $this->getFirstAncestorOfType("Form")->getId();
		$onclick = "document.getElementById('$formId').ACTION.value='".$this->action."';";
		if($this->hasAnchestorOfType("DataSeries") && $this->hasAnchestorOfType("Form")) {
			$onclick .= "document.getElementById('$formId').".DataTable::DATATABLE_ROW.".value='$index';";
		}
		$onclick .= "jQuery('form#".$formId."').submit();";
		if(!empty($this->popup)) {
			$msg = $this->getConvertedValue($this->popup, $index);
			$onclick = "if(confirm('$msg')){".$onclick."}else{return false;}";
		}
		return "<a href=\"#\" onclick=\"$onclick\">".$this->getConvertedValue($this->value, $index)."</a>";
	}

}
?>