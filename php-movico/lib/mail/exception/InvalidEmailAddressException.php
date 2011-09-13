<?php
class InvalidEmailAddressException extends MailException {
	
	private $address;
	
	public function __construct($address) {
		$this->address = $address;
	}
	
	public function getAddress() {
		return $this->address;
	}
	
}
?>