<?php
class MapToStringTest extends UnitTestCase {
		
	function testEmptyMap() {
		$map = new HashMap("string", "integer");
		$this->assertEqual("{}", $map->__toString());
	}
	
	function testNormalMap() {
		$map = new HashMap("string", "integer");
		$map->put("123", 4);
		$map->put("567", 8);
		$this->assertEqual("{123:4,567:8}", $map->__toString());
	}
	
}
?>