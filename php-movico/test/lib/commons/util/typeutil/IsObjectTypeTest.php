<?
class IsObjectTypeTest extends UnitTestCase {
	
	function testNormalObjectType() {
		$this->assertTrue(TypeUtil::isObjectType("IsObjectTypeTest"));
	}
	
	function testPrimitiveIsNotObjectType() {
		$this->assertFalse(TypeUtil::isObjectType("string"));
	}
	
}
?>