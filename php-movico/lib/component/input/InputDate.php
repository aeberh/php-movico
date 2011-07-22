<?php
class InputDate extends Component {
	
	private $value;
	private $format;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setFormat($format) {
		$this->format = $format;
	}
	
	public function doRender($index=null) {
		return "<input type=\"text\" id=\"".$this->id."\" name=\"".$this->value."\"/>".
			"<input type=\"hidden\" name=\"_type_".$this->value."\" value=\"Date\"/>".
			"<input type=\"hidden\" name=\"_format_".$this->value."\" value=\"".$this->format."\"/>".
			"<script>$(\"#".$this->id."\").datepicker({dateFormat:'".$this->format."'});</script>";
	}
	
	public function getValidParents() {
		return array("div", "Form");
	}
	
}
?>