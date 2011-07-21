<?
abstract class AbstractInput extends Component {
	
	private $value;
	private $autoFocus;
	private $maxLength;

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setAutoFocus($autoFocus) {
		$this->autoFocus = $autoFocus;
	}
	
	public function setMaxLength($maxLength) {
		$this->maxLength = $maxLength;
	}
	
	public function doRender($row=null) {
		$name = $this->value;
		if(!is_null($row)) {
			$dtComp = $this->getFirstAncestorOfType("DataSeries");
			$dtVar = $dtComp->getVar();
			$dtValue = BeanUtil::getBeanString($dtComp->getValue())."($row)";
			$name = str_replace($dtVar, $dtValue, $this->value);
		}
		$val = $this->getConvertedValue($this->value, $row);
		$type = $this->getType();
		$focus = $this->autoFocus === "true" ? " class=\"autofocus\"" : "";
		return "<input id=\"".$this->id."\" maxlength=\"".$this->maxLength."\" type=\"$type\" name=\"$name\" value=\"$val\"$focus/>";
	}
	
	public abstract function getType();
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "p", "PanelSeries", "div");
	}
	
}
?>