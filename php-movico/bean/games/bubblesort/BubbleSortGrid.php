<?php
class BubbleSortGrid {
	
	private $fields;
	
	private function __construct($fields) {
		$this->fields = $fields;
	}
	
	public static function generate() {
		$fields = new ArrayList("BubbleSortField");
		for($i=0; $i<16; $i++) {
			$bubble = null;
			do {
				$bubble = new BubbleSortField();
			} while(self::alreadyHasValue($fields, $bubble->getValue()));
			$fields->add($bubble);
		}
		return new BubbleSortGrid($fields);
	}
	
	public function click($index) {
		if($index == $this->getMaximumUnselectedIndex()) {
			$this->fields->get($index)->setAvailable(false);
		}
		return !$this->hasAvailables();
	}
	
	private function hasAvailables() {
		foreach($this->fields as $field) {
			if($field->isAvailable()) {
				return true;
			}
		}
		return false;
	}
	
	private static function alreadyHasValue($fields, $value) {
		foreach($fields as $field) {
			if($field->getValue() === $value) {
				return true;
			}
		}
		return false;
	}
	
	private function getMaximumUnselectedIndex() {
		$max = -1;
		$resultIndex = -1;
		for($i=0; $i<$this->fields->size(); $i++) {
			$field = $this->fields->get($i);
			if($field->isAvailable() && $field->getValue()>$max) {
				$max = $field->getValue();
				$resultIndex = $i;
			}
		}
		return $resultIndex;
	}
	
	public function getFieldsArray() {
		return $this->fields->toArray();
	}
	
}
?>