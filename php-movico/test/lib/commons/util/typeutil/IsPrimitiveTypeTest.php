<?php
class IsPrimitiveTypeTest extends UnitTestCase {
	
	function testIntegerIsPrimitive() {
		$this->assertTrue(TypeUtil::isPrimitive("integer"));
	}
	
	function testFloatIsPrimitive() {
		$this->assertTrue(TypeUtil::isPrimitive("float"));
	}
		
	function testStringIsPrimitive() {
		$this->assertTrue(TypeUtil::isPrimitive("string"));
	}
		
	function testBooleanIsPrimitive() {
		$this->assertTrue(TypeUtil::isPrimitive("boolean"));
	}
	
	function testObjectIsNotPrimitive() {
		$this->assertFalse(TypeUtil::isPrimitive("IsPrimitiveTypeTest"));
	}
	
}
?>