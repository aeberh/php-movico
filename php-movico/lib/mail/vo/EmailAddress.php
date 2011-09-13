<?php
class EmailAddress {
	
	private $name;
	private $address;
	
	public function __construct($address, $name="") {
		self::validate($address);
		$this->address = $address;
		$this->name = $name;
	}
	
	public function getFullAddress() {
		if(empty($this->name)) {
			return $this->address;
		}
		return $this->name." <".$this->address.">";
	}
	
	public function __toString() {
		return $this->getFullAddress();
	}
	
	public static function validate($address) {
		if(filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
			throw new InvalidEmailAddressException($address);
		}
	}
	
}
?>