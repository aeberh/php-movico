<?php
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

class ArrayList {
	
	private $elements = array();
	private $type;
	
	/**
	 * Create a new ArrayList that contains elements of the given type.
	 * @param $type
	 */
	public function __construct($type) {
		$this->type = $type;
	}
	
	public function add($element, $position=-1) {
		if(!$this->isCorrectType($element)) {
			throw new IllegalArgumentException();
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
	
	public function join($delimiter) {
		return implode($delimiter, $this->elements);
	}
	
	public function indexOf($search) {
		if(!$this->isCorrectType($search)) {
			throw new IllegalArgumentException();
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
		if(!is_object($element)) {
			return $this->type === gettype($element);
		}
		return $this->type === get_class($element);
	}
	
	private function isValidIndex($i) {
		return is_int($i) && $i >= 0 && $i < $this->size();
	}
	
	public function __toString() {
		return "[".implode(",", $this->elements)."]";
	}
	
	public function sort(Comparator $comparator) {
		
	}
	
}

class IndexOutOfBoundsException extends Exception {}

class IllegalArgumentException extends Exception {}
?>

<h1>ArrayList</h1>
<?php 
try {
	$list = new ArrayList("string");
	$list->add("one");
	$list->add("two");
	
	$first = $list->get(5);
} catch(Exception $e) {
	echo "Error! $e";
}
?>
<?=$list?>
<?=$first?>