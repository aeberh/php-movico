<?php
class DomainBooleanConverter implements DomainConverter {
	
	public function fromViewtoDom($strValue) {
		return String::create($strValue);
	}
	
	public function fromDomtoView($objValue) {
		return $objValue->__toString();
	}
	
}
?>