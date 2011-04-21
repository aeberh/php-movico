<?
class ArrayList {
	
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
	
	public function add($element, $position=-1) {
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
			throw new ListException();
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
	
	private function isCorrectType($element) {
		if($this->type === "?") {
			return true;
		}
		if(!is_object($element)) {
			return $this->type === gettype($element);
		}
		return $this->type === get_class($element);
	}
	
	private function isValidIndex($i) {
		return is_int($i) && $i >= 0 && $i < $this->size();
	}
	
	public function __toString() {
		return "[".$this->join(",")."]";
	}
	
}
?>