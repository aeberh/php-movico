<?
class ValueExpression {
	
	private $comp;
	private $bean;
	private $properties;
	private $index;
	
	public function __construct($strval, Component $comp, $index) {
		$this->validate($strval);
		$beanString = $strval->removeAll(ArrayList::fromArray("string", array("#{", "}")));
		$delim = $beanString->contains("_") ? "_" : ".";
		$result = $beanString->split($delim);
		$this->bean = $result[0];
		
		
		$this->strval = $strval;
		$this->comp = $comp;
		$this->index = $index;
	}

	private function validate(String $strval) {
		$matches = $strval->getMatches(new String("/#\{.+\}/"));
		if($matches->size() != 1) {
			throw new InvalidValueExpressionException($strval, "multiple expression matches");
		}
		$first = $matches->get(0);
		$expression = $first[0];
		if(!isset($expression) || $expression!=$strval) {
			throw new InvalidValueExpressionException($strval, "expression doesn't match #{} format");
		}
	}
	
	private function getBeanAndProperties($fromPost=false) {
		$beanString = str_replace("}", "", str_replace("#{", "", $valueExpression));
		$delim = $fromPost ? self::POST_DELIM : self::DELIM;
		$result = explode($delim, $beanString, 2);
		return array($result[0], str_replace(self::POST_DELIM, self::DELIM, $result[1]));
	}
	
}
?>