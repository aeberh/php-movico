<?php
class StringLengthTest extends UnitTestCase {
	
	function testEmptyStringHasZeroSize() {
		$empty = new String("");
		$this->assertEqual(0, $empty->length());
	}
	
	function testSampleStringSize() {
		$sample = new String("abc");
		$this->assertEqual(3, $sample->length());
	}
	
}
?>