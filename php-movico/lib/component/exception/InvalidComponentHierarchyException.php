<?
class InvalidComponentHierarchyException extends Exception {
	
	public function __construct($parent, $child) {
		$this->message = "Component '$child' is not allowed as a child of '$parent'";
	}
	
}
?>