<?
class CommandButton extends Component {
	
	private $action;
	private $value;
	private $popup;
	
	public function setAction($action) {
		$this->action = $action;
	}

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setPopup($popup) {
		$this->popup = $popup;
	}
	
	public function doRender($index=null) {
		if(!$this->rendered) {
			return "";
		}
		$onclick = "this.form.ACTION.value='".$this->action."';";
		if($this->hasAnchestorOfType("DataTable") && $this->hasAnchestorOfType("Form")) {
			$onclick .= "this.form.".DataTable::DATATABLE_ROW.".value='$index';";
		}
		if(!empty($this->popup)) {
			$msg = $this->getConvertedValue($this->popup, $index);
			$onclick = "if(confirm('$msg')){".$onclick."}else{return false;}";
		}
		return "<button type=\"submit\" onclick=\"$onclick\">".$this->value."</button>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup");
	}
	
}
?>