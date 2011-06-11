<?php
class AjaxErrorBean extends RequestBean {
	
	public function throwException() {
		throw new SomeException();
	}
	
	public function throwError() {
		$a->bla();
	}
	
}

class SomeException extends Exception {
	
}
?>