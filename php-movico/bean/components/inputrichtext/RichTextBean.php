<?php
class RichTextBean extends RequestBean {
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function submit() {
		return null;
	}
	
}
?>