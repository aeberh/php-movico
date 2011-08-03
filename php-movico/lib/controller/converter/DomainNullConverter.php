<?php
class DomainNullConverter implements DomainConverter {
	
	public function fromViewtoDom($value) {
		return $value;
	}
	
}
?>