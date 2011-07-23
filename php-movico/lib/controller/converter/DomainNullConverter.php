<?php
class DomainNullConverter implements DomainConverter {
	
	public function fromViewtoDom($value) {
		return $value;
	}
	
	public function fromDomtoView($objValue) {
		return $objValue;
	}
	
}
?>