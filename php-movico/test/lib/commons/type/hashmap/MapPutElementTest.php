<?php
class MapPutElementTest extends UnitTestCase {
	
	private $map;
	
	public function __construct() {
		$map = new HashMap("string", "string");
	}
	
	function testPutInvalidKey() {
		$map = new HashMap("integer", "string");
		$this->expectException("IllegalArgumentException");
		$map->put("blabla", "test");
	}
	
	function testPutInvalidValue() {
		$map = new HashMap("integer", "string");
		$this->expectException("IllegalArgumentException");
		$map->put(5, 10);
	}
	
	function testPutValidElement() {
		$map = new HashMap("integer", "string");
		$map->put(4, "Peter");
		$this->assertEqual("Peter", $map->get(4));
	}
	
	function testPutSameElementTwice() {
		$map = new HashMap("integer", "string");
		$map->put(4, "Peter");
		$map->put(4, "Raf");
		$this->assertEqual(1, $map->size());
		$this->assertEqual("Raf", $map->get(4));
	}

}
?>