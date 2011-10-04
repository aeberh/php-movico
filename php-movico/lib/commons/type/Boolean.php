<?php
class Boolean {
	
	private $bool;
	
	public function __construct($bool) {
		$this->bool = $bool;
	}
	
	public static function fromString($bit) {
		if(bit === "1") {
			return new Boolean(true);
		} else if(bit === "0") {
			return new Boolean(false);
		}
		return null;
	}
	
	public static function true() {
		return new Boolean(true);
	}
	
	public static function false() {
		return new Boolean(false);
	}
	
	public function __toString() {
		return $this->bool ? "true" : "false";
	}
	
}
?>