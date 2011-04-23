<?
class ListContainsTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("string");
		$this->list->add("First");
		$this->list->add("Second");
		$this->list->add("Third");
	}
	
	function testActualContainsFirst() {
		$this->assertTrue($this->list->contains("First"));
	}
	
	function testActualContainsSecond() {
		$this->assertTrue($this->list->contains("Second"));
	}
	
	function testActualContainsThird() {
		$this->assertTrue($this->list->contains("Third"));
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