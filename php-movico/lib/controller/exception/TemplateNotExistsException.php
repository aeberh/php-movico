<?php
class TemplateNotExistsException extends Exception {
	
	public function __construct($template) {
		$this->message = "Template '$template.xml' was not found";
	}
	
}
?>