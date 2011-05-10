<?
class BubbleSortGrid {
	
	private $fields;
	
	private function __construct($fields) {
		$this->fields = $fields;
	}
	
	public static function generate() {
		$fields = new ArrayList("BubbleSortField");
		for($i=0; $i<16; $i++) {
			$fields->add(new BubbleSortField());
		}
		return new BubbleSortGrid($fields);
	}
	
	public function click($index) {
		if($index == $this->getMaximumUnselectedIndex()) {
			$this->fields->get($index)->setAvailable(false);
		}
	}
	
	private function getMaximumUnselectedIndex() {
		$max = -1;
		$resultIndex = -1;
		for($i=0; $i<$this->fields->size(); $i++) {
			$field = $this->fields->get(0);
			if($field->isAvailable() && $field->getValue()>$max) {
				$max = $field->getValue();
				$result = $i;
			}
		}
		return $result;
	}
	
	public function getFieldsArray() {
		return $this->fields->toArray();
	}
	
}
?>