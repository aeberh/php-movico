<?
class CommandButton extends AbstractCommand {

	public function doRender($index=null) {
		$onclick = "this.form.ACTION.value='".$this->action."';";
		if($this->hasAnchestorOfType("DataTable") && $this->hasAnchestorOfType("Form")) {
			$onclick .= "this.form.".DataTable::DATATABLE_ROW.".value='$index';";
		}
		if($this->link) {
			$onclick .= "formEl.action='#{$this->getHash()}';";
		}
		if(!empty($this->popup)) {
			$msg = $this->getConvertedValue($this->popup, $index);
			$onclick = "if(confirm('$msg')){".$onclick."}else{return false;}";
		}
		return "<button type=\"submit\" onclick=\"$onclick\">".$this->value."</button>";
	}

}
?>