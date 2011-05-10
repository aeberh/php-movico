<?
class BubbleSortField {
	
	private $value;
	private $available;
	
	public function __construct() {
		$this->value = rand(0, 100);
		$this->available = true;
	}
	
	public function isAvailable() {
		return $this->available;
	}
	
	public function setAvailable($available) {
		$this->available = $available;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
}
?>