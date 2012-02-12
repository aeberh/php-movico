<?php
class ListIndexesOfTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("String");
		$this->list->add(new String("a"));
		$this->list->add(new String("b"));
		$this->list->add(new String("a"));
	}
	
	function testIndexNotFound() {
		$this->assertEqual(new ArrayList("integer"), $this->list->indexesOf(new String("c")));
	}
	
	function testIndexFound() {
		$expected = ArrayList::fromArray("integer", array(0, 2));
		$this->assertEqual($expected, $this->list->indexesOf(new String("a")));
	}
	
}
?>