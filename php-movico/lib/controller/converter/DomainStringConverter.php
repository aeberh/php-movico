<?php
class DomainStringConverter implements DomainConverter {
	
	public function fromViewtoDom($strValue) {
		return String::create($strValue);
	}
	
}
?>