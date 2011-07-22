<?php
class Param extends Component {
	
	private $value;
	
	public function doRender($index=null) {
		$action = $this->getParent()->getAction();
		$value = $this->getConvertedValue($this->value, $index);
		return "<input type=\"hidden\" name=\"ACTION_PARAM[$action][]\" value=\"$value\"/>";
	}
	
	public function getValidParents() {
		return array("AbstractCommand");
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
}
?>