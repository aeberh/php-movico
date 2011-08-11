<?
class StringFromPrimitivesTest extends UnitTestCase {
	
	function testFromArrayToArrayList() {
		$input = array("one", "two");
		$output = String::fromPrimitives($input);
		$this->assertEqual(String::create("one"), $output->get(0));
		$this->assertEqual(String::create("two"), $output->get(1));
	}
	
}