<?php
class ArrayIterator implements Iterator {
	
	private $elements;
	
	public function __construct($elements) {
		$this->elements = $elements;
	}
	
	public function rewind() {
		reset($this->elements);
	}

	public function current() {
		return current($this->elements);
	}

	public function key() {
		return key($this->elements);
	}

	public function next() {
		return next($this->elements);
	}

	public function valid() {
		$key = $this->key();
		return ($key !== null && $key !== false);
	}
	
}
?>