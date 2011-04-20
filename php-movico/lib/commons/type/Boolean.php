<?
class Boolean {
	
	private $bool;
	
	public function __construct($bool) {
		$this->bool = $bool;
	}
	
	public function __toString() {
		return $this->bool ? "true" : "false";
	}
	
}
?>