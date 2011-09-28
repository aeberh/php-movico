<?php
class SelectManyListBox extends Component {
	
	protected $value;
	protected $options;
	
	public function doRender($rowIndex=null) {
		$name = $this->value;
		$val = $this->getConvertedValue($name, $rowIndex);
		if(is_null($val)) {
			$val = array();
		}
		$result = "<select id=\"".$this->id."\" name=\"{$name}[]\" multiple=\"multiple\">";
		$optionList = $this->getConvertedValue($this->options, $rowIndex);
		foreach($optionList as $oValue=>$oLabel) {
			$sel = in_array($oValue, $val) ? " selected=\"selected\"" : "";
			$result .= "<option$sel value=\"$oValue\">$oLabel</option>";
		}
		return $result."</select>";
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setOptions($options) {
		$this->options = $options;
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "p", "div");
	}
	
}
?>