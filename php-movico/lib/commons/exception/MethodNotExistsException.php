<?
class MethodNotExistsException extends Exception {
	
	public function __construct($className, $methodName) {
		$this->message = "There is no method '$methodName' in class '$className'";
	} 
	
}
?>