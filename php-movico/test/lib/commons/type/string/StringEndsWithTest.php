<?
class StringEndsWithTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testStringNeverEndsWithBlank() {
		$this->assertFalse($this->input->endsWith(""));
	}
	
	function testStringRealEnd() {
		$this->assertTrue($this->input->endsWith("Mesotten"));
	}
	
	function testStringFalseEnd() {
		$this->assertFalse($this->input->endsWith("Peter"));
	}
	
}
?>