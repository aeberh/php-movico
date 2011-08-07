<?
class CommandButton extends AbstractCommand {

	public function doRender($index=null) {
		$onclick = "this.form.ACTION.value='".$this->action."';";
		if($this->hasAnchestorOfType("DataTable") && $this->hasAnchestorOfType("Form")) {
			$action = str_replace(array("#", "{", "}", "."), array("\\\\#", "\\\\{", "\\\\}", "\\\\."), $this->action);
			$onclick .= "this.form.".DataTable::DATATABLE_ROW.".value='$index'; jQuery('input[name^=ACTION_PARAM\\\\[{$action}_{$index}\\\\]]').removeAttr('disabled');";
		}
		if($this->link) {
			$onclick .= "formEl.action='{$this->getHref()}';";
		}
		if(!empty($this->popup)) {
			$msg = $this->getConvertedValue($this->popup, $index);
			$onclick = "if(confirm('$msg')){".$onclick."}else{return false;}";
		}
		return "<button type=\"submit\" onclick=\"$onclick\">".$this->value."</button>".$this->renderParams($index);
	}
	
}
?>