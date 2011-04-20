<?
abstract class AbstractInput extends Component {
	
	private $value;

	public function setValue($value) {
		$this->value = $value;
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
		return "<input id=\"".$this->id."\" type=\"$type\" name=\"$name\" value=\"$val\"/>";
	}
	
	public abstract function getType();
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "p", "PanelSeries");
	}
	
}
?>