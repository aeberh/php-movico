<?
class ComponentNotExistsException extends Exception {
	
	public function __construct($component) {
		$this->message = "Component '$component' does not exist or does not extend Component";
	}
	
}
?>