<?php
class OutputDate extends Component {
	
	private $value;
	private $format;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setFormat($format) {
		$this->format = $format;
	}

	public function doRender($row=null) {
		$date = $this->getConvertedValue($this->value, $row);
		$format = empty($this->format) ? Date::DEFAULT_FORMAT : $this->getConvertedValue($this->format);
		$value = $date->format($format);
		return "<span>$value</span>";
	}
	
}
?>