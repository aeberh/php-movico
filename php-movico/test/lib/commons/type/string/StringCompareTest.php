<?php
class StringCompareTest extends UnitTestCase {
	
	function testCompareDifferentStrings1() {
		$one = new String("a");
		$other = new String("b");
		$this->assertTrue($one->compareTo($other) < 0);
	}
	
	function testCompareDifferentStrings2() {
		$one = new String("b");
		$other = new String("a");
		$this->assertTrue($one->compareTo($other) > 0);
	}
	
	function testCompareEqualStrings() {
		$one = new String("a");
		$other = new String("a");
		$this->assertTrue($one->compareTo($other) === 0);
	}
	
}