<?
class BooleanCheckbox extends Component {
	
	private $value;
	private $label;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setLabel($label) {
		$this->label = $label;
	}
	
	public function doRender($rowIndex=null) {
		$name = $this->value;
		$value = $this->getConvertedValue($name, $rowIndex);
		$checked = $value ? " checked=\"checked\"" : "";
		$defValue = $value ? "1" : "0";
		$result = "<table cellspacing=\"0\" cellpadding=\"0\"><tr>".
			"<td><input type=\"checkbox\" id=\"{$this->id}\"$checked onclick=\"toggleBooleanValue('hidden_{$this->id}')\"/>".
			"<input type=\"hidden\" id=\"hidden_{$this->id}\" name=\"$name\" value=\"$defValue\"></td>";
		if(isset($this->label)) {
			$result .= "<td><label for=\"{$this->id}\">{$this->label}</label></td>";
		}
		return $result."</tr></table>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column");
	}
	
}
?>