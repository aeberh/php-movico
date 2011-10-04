<?php
class HashSet extends ArrayList implements IteratorAggregate {

	public function add($element) {
		if(!$this->isCorrectType($element)) {
			throw new IllegalArgumentException("Tried to add element of type ".TypeUtil::getType($element)." to list of type ".$this->type);
		}
		$this->elements[$element] = $element;
	}

	public function __toString() {
		return "(".$this->join(",").")";
	}
	
}
?>