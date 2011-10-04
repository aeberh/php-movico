<?php
class BooleanCheckbox extends Component {
	
	private $value;
	private $label;
	private $action;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setLabel($label) {
		$this->label = $label;
	}
	
	public function setAction($action) {
		$this->action = $action;
	}
	
	public function doRender($rowIndex=null) {
		$name = $this->value;
		$value = $this->getConvertedValue($name, $rowIndex);
		$checked = $value ? " checked=\"checked\"" : "";
		$defValue = $value ? "1" : "0";
		$buttonId = rand(10000, 99999);
		$onchangesubmit = isset($this->action) ? "this.form.".MovicoRequest::ACTION.".value='".$this->action."';$('#$buttonId').click();\"" : "";
		$result = "<input type=\"checkbox\" id=\"{$this->id}\"$checked onclick=\"toggleBooleanValue('hidden_{$this->id}');$onchangesubmit\"/>".
			"<input type=\"hidden\" id=\"hidden_{$this->id}\" name=\"$name\" value=\"$defValue\">";
			//"<input type=\"hidden\" name=\"_type_".$name."\" value=\"Boolean\"/>";
		if(isset($this->label)) {
			$result .= "<label for=\"{$this->id}\">{$this->label}</label>";
		}
		if(isset($this->action)) {
			$result .= "<button id=\"$buttonId\" type=\"submit\" style=\"display:none\">Dummy</button>";
		}
		return $result;
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "p");
	}
	
}
?>