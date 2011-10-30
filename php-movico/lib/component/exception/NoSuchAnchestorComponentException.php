<?php
class NoSuchAnchestorComponentException extends Exception {
	
	public function __construct($child, $parent) {
		$this->message = "Component '$child' does not have an anchestor of type '$parent'";
	}
	
}
?>