<?
class ValueExpression {
	
	private $bean;
	private $properties;
	
	public function __construct($strval) {
		$this->validate($strval);
		$beanString = String::create($strval)->remove("#{")->remove("}");
		$delim = $beanString->contains("_") ? "_" : ".";
		$result = $beanString->split($delim);
		$this->bean = $result->getSublist(0, 1)->get(0);
		try {
			$this->properties = $result->getSublist(1);
		} catch(IndexOutOfBoundsException $e) {
			$this->properties = new ArrayList("?");
		}
	}
	
	public function getBean() {
		return $this->bean;
	}
	
	public function getProperties() {
		return $this->properties;
	}

}
?>