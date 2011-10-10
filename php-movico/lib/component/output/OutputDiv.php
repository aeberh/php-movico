<?php
class OutputDiv extends Component {
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}

	public function doRender($row=null) {
		$c = $this->class;
		$class = empty($c) ? "" : " class=\"$c\"";
		return "<div$class>".$this->getConvertedValue($this->value, $row)."</div>";
	}
	
}
?>
