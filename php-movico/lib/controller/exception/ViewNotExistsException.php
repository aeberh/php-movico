<?
class ViewNotExistsException extends Exception {
	
	public function __construct($view) {
		$this->message = "View '$view.xml' was not found";
	}
	
}
?>