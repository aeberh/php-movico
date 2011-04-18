<?
class HashMap {
	
	private $elements = array();
	private $keyType;
	private $valueType;
	
	public function __construct($keyType, $valueType) {
		$this->keyType = $keyType;
		$this->valueType = $valueType;
	}
	
}
?>