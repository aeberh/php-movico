<?php
class DomainStringConverter implements DomainConverter {
	
	public function fromViewtoDom($strValue) {
		return strval($strValue);
	}
	
	public function fromDomtoView($objValue) {
		return strval($objValue);
	}
	
}
?>