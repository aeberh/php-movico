<?
class StringCharAtTest extends UnitTestCase {
	
	function testEmptyString() {
		$this->expectException("IndexOutOfBoundsException");
		String::BLANK()->charAt(2);
		$this->expectException("IndexOutOfBoundsException");
		String::BLANK()->charAt(0);
	}
	
	function testNegativeIndex() {
		$this->expectException("IndexOutOfBoundsException");
		String::create("Bla")->charAt(-1);
		$this->expectException("IndexOutOfBoundsException");
		String::create("Bla")->charAt(3);
	}
	
	function testOkIndex() {
		$bla = String::create("Bla");
		$this->assertEqual(String::create("B"), $bla->charAt(0));
		$this->assertEqual(String::create("l"), $bla->charAt(1));
		$this->assertEqual(String::create("a"), $bla->charAt(2));
	}
	
}