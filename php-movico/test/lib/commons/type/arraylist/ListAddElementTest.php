<?
class ListAddElementTest extends UnitTestCase {
	
	function testAddValidElement() {
		$list = new ArrayList("string");
		$list->add("Hello there");
		$this->assertTrue($list->contains("Hello there"));
	}
	
	function testAddInvalidElement() {
		$list = new ArrayList("string");
		$this->expectException("IllegalArgumentException");
		$list->add(1223);
		$this->assertFalse($list->contains("Hello there"));
	}
	
	function testAddSameElementTwice() {
		$list = new ArrayList("string");
		$list->add("Hello there");
		$list->add("Hello there");
		$this->assertEqual(2, $list->size());
	}
	
}
?>