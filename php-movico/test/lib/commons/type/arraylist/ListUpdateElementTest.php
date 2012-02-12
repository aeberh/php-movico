<?php
class ListUpdateElementTest extends UnitTestCase {
	
	public function testUpdateElementCheckChanged() {
		$list = new ArrayList("SomePojo");
		$list->add(new SomePojo(5));
		$list->add(new SomePojo(8));
		
		$list->get(1)->setField(7);
		$this->assertEqual(5, $list->get(0)->getField());
		$this->assertEqual(7, $list->get(1)->getField());
	}
	
}

class SomePojo {
	
	private $field;
	
	public function __construct($field) {
		$this->setField($field);
	}
	
	public function setField($field) {
		$this->field = $field;
	}
	
	public function getField() {
		return $this->field;
	}
	
}
?>