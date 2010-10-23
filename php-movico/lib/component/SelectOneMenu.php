<?
class SelectOneMenu extends Component {
	
	private $value;
	private $options;
	
	public function render($index=null) {
		$name = $this->value;
		$val = BeanUtil::getProperty($name);
		$result = "<select";
		if(!empty($this->id)) {
			$result .= " id=\"".$this->id."\"";
		}
		$result .= " name=\"$name\">";
		$optionList = BeanUtil::getProperty($this->options);
		foreach($optionList as $oValue=>$oLabel) {
			$sel = ($val === $oValue) ? " selected=\"selected\"" : "";
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
		return array("View", "Form", "PanelGrid", "Column");
	}
	
}
?>