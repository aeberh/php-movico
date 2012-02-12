<?php
class ListToStringTest extends UnitTestCase {
	
	function testEmptyList() {
		$list = new ArrayList("string");
		$this->assertEqual("[]", $list->__toString());
	}
	
	function testNormalList() {
		$list = new ArrayList("string");
		$list->add("a");
		$list->add("b");
		$this->assertEqual("[a,b]", $list->__toString());
	}
	
}
?>