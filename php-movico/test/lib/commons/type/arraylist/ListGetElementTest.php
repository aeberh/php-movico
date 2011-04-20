<?
class ListGetElementTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("string");
		$this->list->add("First");
		$this->list->add("Second");
		$this->list->add("Third");
	}
	
	function testGetFirstIndex() {
		$this->assertEqual("First", $this->list->get(0));
	}
	
	function testGetLastIndex() {
		$this->assertEqual("Third", $this->list->get(2));
	}
	
	function testGetInvalidIndex() {
		$this->expectException("IndexOutOfBoundsException");
		$this->list->get(-1);
	}
	
}
?>