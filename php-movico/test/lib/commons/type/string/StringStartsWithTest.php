<?
class StringStartsWithTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testStringNeverStartsWithBlank() {
		$this->assertFalse($this->input->startsWith(""));
	}
	
	function testStringRealStart() {
		$this->assertTrue($this->input->startsWith("Peter"));
	}
	
	function testStringFalseStart() {
		$this->assertFalse($this->input->startsWith("Mesotten"));
	}
	
}
?>