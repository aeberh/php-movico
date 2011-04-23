<?
class ArrayList implements IteratorAggregate {
	
	private $elements = array();
	private $type;

	public function __construct($type) {
		if(!is_string($type)) {
			throw new IllegalArgumentException("Type parameter must be a string");
		}
		$this->type = $type;
	}
	
	public static function fromArray($type, array $array) {
		$list = new ArrayList($type);
		foreach($array as $element) {
			$list->add($element);
		}
		return $list;
	}
	
	public function add($element) {
		if(!$this->isCorrectType($element)) {
			throw new IllegalArgumentException("Tried to add element of type ".gettype($element)." to list of type ".$this->type);
		}
		$this->elements[] = $element;
	}
	
	public function get($i) {
		if(!$this->isValidIndex($i)) {
			throw new IndexOutOfBoundsException();
		}
		return $this->elements[$i];
	}
	
	public function size() {
		return count($this->elements);
	}
	
	public function isEmpty() {
		return $this->size() === 0;
	}
	
	public function join($delimiter="") {
		return new String(implode($delimiter, $this->elements));
	}
	
	public function indexOf($search) {
		if(!$this->isCorrectType($search)) {
			throw new IllegalArgumentException("Tried to search element of type ".gettype($search)." in list of type ".$this->type);
		}
		for($i=0; $i<$this->size(); $i++) {
			if($this->elements[$i] === $search) {
				return $i;
			}
		}
		return -1;
	}
	
	public function contains($search) {
		return $this->indexOf($search) >= 0;
	}
	
	public function getSublist($from, $size=null) {
		$l = is_null($size) ? $this->size()-$from : $size;
		if($l<0) {
			throw new IllegalArgumentException("Sublist size cannot be negative");
		}
		if($from<0 || $from+$l > $this->size()) {
			throw new IndexOutOfBoundsException("Sublist is out of bounds");
		}
		$result = array_slice($this->elements, $from, $l);
		return self::fromArray($this->type, $result);
	}

	public function getIterator() {
		return new ArrayIterator($this->elements);
	}
	
	public function sort(Comparator $comparator=null) {
		if(is_null($comparator)) {
			sort($this->elements);
		} else {
			usort($this->elements, function($a, $b) use ($comparator) {
				return $comparator->compare($a, $b);
	        });
		}
	}

	private function isCorrectType($element) {
		if($this->type === "?") {
			return true;
		}
		return $this->type === $this->getType($element);
	}
	
	private function getType($var) {
		if(!is_object($var)) {
			return gettype($var);
		}
		return get_class($var);
	}
	
	private function isValidIndex($i) {
		return is_int($i) && $i >= 0 && $i < $this->size();
	}
	
	public function __toString() {
		return "[".$this->join(",")."]";
	}
	
}
?>