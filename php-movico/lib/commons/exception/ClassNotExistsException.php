<?
class ClassNotExistsException extends Exception {
	
	public function __construct($className) {
		$this->message = "Class '$className' does not exist";
	}
	
}
?>