<?php
class FileNotExistsException extends Exception {

	public function __construct($fileName) {
		$this->message = "File '$fileName' does not exist";
	}
	
}
?>
