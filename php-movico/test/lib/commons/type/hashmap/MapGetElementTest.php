<?php
class MapGetElementTest extends UnitTestCase {
		
	function testUnexistingKeyReturnsNull() {
		$map = new HashMap("string", "integer");
		$this->assertNull($map->get("hello"));
	}
	
	function testUndefinedOffset() {
		$map = new HashMap("integer", "string");
		$this->assertNull($map->get(45));
	}
	
}
?>