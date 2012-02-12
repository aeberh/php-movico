<?php
class ListIteratorTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("string");
		$this->list->add("First");
		$this->list->add("Second");
		$this->list->add("Third");
	}
	
	function testIterate() {
		$result = "";
		foreach($this->list as $item) {
			$result .= $item;
		}
		$this->assertEqual("FirstSecondThird", $result);
	}
	
}
?>