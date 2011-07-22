<?
class SelectOneMenu extends Component {
	
	private $value;
	private $options;
	private $action;
	
	/*
	 * Create an addiontal hidden commandbutton and click it to submit
	 */
	
	public function doRender($rowIndex=null) {
		$name = $this->value;
		$val = $this->getConvertedValue($name, $rowIndex);
		$buttonId = rand(10000, 99999);
		$onchange = isset($this->action) ? " onchange=\"this.form.ACTION.value='".$this->action."';$('#$buttonId').click();\"" : "";
		$result = "<select id=\"".$this->id."\" name=\"$name\"$onchange>";
		$optionList = $this->getConvertedValue($this->options, $rowIndex);
		foreach($optionList as $oValue=>$oLabel) {
			$sel = (strval($val) == strval($oValue)) ? " selected=\"selected\"" : "";
			$result .= "<option$sel value=\"$oValue\">$oLabel</option>";
		}
		$result .= "</select>";
		if(isset($this->action)) {
			$result .= "<button id=\"$buttonId\" type=\"submit\" style=\"display:none\">Dummy</button>";
		}
		return $result;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setOptions($options) {
		$this->options = $options;
	}
	
	public function setAction($action) {
		$this->action = $action;
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "p");
	}
	
}
?>