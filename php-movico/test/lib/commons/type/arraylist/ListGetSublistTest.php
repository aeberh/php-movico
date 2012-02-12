<?php
class ListGetSublistTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("string");
		$this->list->add("First");
		$this->list->add("Second");
		$this->list->add("Third");
		$this->list->add("Fourth");
	}
	
	function testNegativeOffset() {
		$this->expectException("IndexOutOfBoundsException");
		$this->list->getSublist(-4);
	}
	
	function testNegativeLength() {
		$this->expectException("IllegalArgumentException");
		$this->list->getSublist(4, -2);
	}
	
	function testZeroLength() {
		$result = $this->list->getSublist(2, 0);
		$this->assertTrue($result->isEmpty());
	}
	
	function testOnlyFromOffset() {
		$result = $this->list->getSublist(1);
		$this->assertEqual(3, $result->size());
		$this->assertEqual("Second", $result->get(0));
		$this->assertEqual("Third", $result->get(1));
		$this->assertEqual("Fourth", $result->get(2));
	}
	
	function testFromAndLengthOffsets() {
		$result = $this->list->getSublist(1, 2);
		$this->assertEqual(2, $result->size());
		$this->assertEqual("Second", $result->get(0));
		$this->assertEqual("Third", $result->get(1));
	}
	
	function testOutOfBoundsOffsets() {
		$this->expectException("IndexOutOfBoundsException");
		$this->list->getSublist(2, 5);
	}
	
}
?>