<?php
class OutputText extends Component {
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}

	public function doRender($row=null) {
		$c = $this->class;
		$class = empty($c) ? "" : " class=\"$c\"";
		return "<span id=\"{$this->id}\"$class>".$this->getConvertedValue($this->value, $row)."</span>";
	}
	
}
?>
