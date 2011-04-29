<?
class ArrayList implements IteratorAggregate {
	
	protected $elements = array();
	protected $type;

	public function __construct($type="?") {
		if(!is_string($type)) {
			throw new IllegalArgumentException("Type parameter must be a string");
		}
		$this->type = $type;
	}
	
	public static function fromArray($type, array $array) {
		$list = new self($type);
		foreach($array as $element) {
			$list->add($element);
		}
		return $list;
	}
	
	public function toArray() {
		return $this->elements;
	}
	
	public function add($element) {
		if(!$this->isCorrectType($element)) {
			throw new IllegalArgumentException("Tried to add element of type ".TypeUtil::getType($element)." to list of type ".$this->type);
		}
		$this->elements[] = $element;
	}
	
	public function get($i) {
		if(!$this->isValidIndex($i)) {
			throw new IndexOutOfBoundsException();
		}
		return $this->getElement($i);
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
	
	public function indexOf($search, $offset=0) {
		if(!$this->isCorrectType($search)) {
			throw new IllegalArgumentException("Tried to search element of type ".TypeUtil::getType($search)." in list of type ".$this->type);
		}
		for($i=$offset; $i<$this->size(); $i++) {
			if($this->getElement($i) == $search) {
				return $i;
			}
		}
		return -1;
	}
	
	public function indexesOf($search) {
		$result = new ArrayList("integer");
		$offset = 0;
		do {
			$index = $this->indexOf($search, $offset);
			if($index == -1) {
				break;
			}
			$result->add($index);
			$offset = $index+1;
		} while(true);
		return $result;
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
			if(TypeUtil::isPrimitive($this->type)) {
				sort($this->elements);
			} elseif(TypeUtil::isObjectType($this->type)) {
				if(!TypeUtil::isClassComparable($this->type)) {
					throw new ListNotSortableException("List of type ".$this->type." is not sortable");
				}
				usort($this->elements, function($a, $b) {
					return $a->compareTo($b);
		        });
			}
		} else {
			usort($this->elements, function($a, $b) use ($comparator) {
				return $comparator->compare($a, $b);
	        });
		}
	}
	
	public function getFirst() {
		if($this->isEmpty()) {
			throw new IndexOutOfBoundsException();
		}
		return $this->getElement(0);
	}
	
	public function getLast() {
		if($this->isEmpty()) {
			throw new IndexOutOfBoundsException();
		}
		return $this->getElement($this->size()-1);
	}
	
	public function addAll(ArrayList $list) {
		foreach($list as $element) {
			$this->add($element);
		}
	}
	
	public function getRandomElement() {
		return $this->getElement(array_rand($this->getElements()));
	}
	
	public function shuffle() {
		shuffle($this->elements);
	}
	
	private function getElements() {
		return array_values($this->elements);
	}
	
	private function getElement($i) {
		$els = $this->getElements();
		return $els[$i];
	}

	protected function isCorrectType($element) {
		if($this->type === "?") {
			return true;
		}
		return $this->type === TypeUtil::getType($element);
	}
	
	private function isValidIndex($i) {
		return is_int($i) && $i >= 0 && $i < $this->size();
	}
	
	public function __toString() {
		return "[".$this->join(",")."]";
	}
	
}
?>