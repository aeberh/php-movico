<?php
class Param extends Component {
	
	private $value;
	
	public function doRender($index=null) {
		$action = $this->getParent()->getAction();
		$value = $this->getConvertedValue($this->value, $index);
		return "<input type=\"hidden\" disabled name=\"".MovicoRequest::ACTION_PARAM."[{$action}_{$index}][]\" value=\"$value\"/>";
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function getValue() {
		return $this->value;
	}
	
}
?>