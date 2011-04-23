<?
class StringRemoveTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testRemoveEmptyString() {
		$this->assertEqual("Peter Mesotten", $this->input->remove(""));
	}
	
	function testRemoveNotContainingString() {
		$this->assertEqual("Peter Mesotten", $this->input->remove("Raf"));
	}
	
	function testRemoveContainingString() {
		$this->assertEqual("Mesotten", $this->input->remove("Peter "));
	}
	
}
?>