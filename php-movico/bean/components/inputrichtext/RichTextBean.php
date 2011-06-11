<?php
class RichTextBean extends RequestBean {
	
	private $text;
	
	public function setText($text) {
		$this->text = $text;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function submit() {
		return null;
	}
	
}
?>