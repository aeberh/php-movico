<?php
class DomainDateConverter implements DomainConverter {
	
	public function fromViewtoDom($value) {
		return Date::fromString($value, InputDate::DATE_TRANSFER_FORMAT);
	}
	
}
?>