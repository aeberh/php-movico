<?
class StringReplaceTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testReplaceUnexisting() {
		$this->assertEqual("Peter Mesotten", $this->input->replace("Raf", "Test"));
	}
	
	function testRemoveExisting() {
		$this->assertEqual("Test Mesotten", $this->input->replace("Peter", "Test"));
	}
	
}
?>