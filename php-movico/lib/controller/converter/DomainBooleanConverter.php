<?php
class DomainBooleanConverter implements DomainConverter {
	
	public function fromViewtoDom($strValue) {
		return String::create($strValue);
	}
	
}
?>