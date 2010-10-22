<?
class NoSuchBeanException extends Exception {
	
	public function __construct($className) {
		$this->message = "Bean '$className' does not exist or does not extend RequestBean or SessionBean";
	}
	
}
?>