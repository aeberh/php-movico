<?php
class SetAddElementTest extends UnitTestCase {
	
	function testAddValidElement() {
		$set = new HashSet("string");
		$set->add("Hello there");
		$this->assertTrue($set->contains("Hello there"));
	}
	
	function testAddInvalidElement() {
		$set = new HashSet("string");
		$this->expectException("IllegalArgumentException");
		$set->add(1223);
		$this->assertFalse($set->contains("Hello there"));
	}
	
	function testAddSameElementTwice() {
		$set = new HashSet("string");
		$set->add("Hello there");
		$set->add("Hello there");
		$this->assertEqual(1, $set->size());
		$this->assertEqual("Hello there", $set->get(0));
	}
	
}
?>