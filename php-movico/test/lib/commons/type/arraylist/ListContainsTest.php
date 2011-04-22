<?
class ListContainsTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("string");
		$this->list->add("First");
		$this->list->add("Second");
		$this->list->add("Third");
	}
	
	function testActualContains() {
		$this->assertTrue($this->list->contains("Second"));
	}
	
	function testFalseContains() {
		$this->assertFalse($this->list->contains("Forth"));
	}
	
	function testWrongType() {
		$this->expectException("IllegalArgumentException");
		$this->list->contains(new String("Blabla"));
	}
	
}
?>