<?
class StringIndexOfTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testBlankStringIsNeverContained() {
		$this->assertEqual(-1, $this->input->indexOf(""));
	}
	
	function testRealContainedString() {
		$this->assertEqual(2, $this->input->indexOf("ter"));
	}
	
	function testFalseContainedString() {
		$this->assertEqual(-1, $this->input->indexOf("QSDqd"));
	}
	
	function testStringItself() {
		$this->assertEqual(0, $this->input->indexOf($this->input));
	}
	
	function testLongerThanString() {
		$this->assertEqual(-1, $this->input->indexOf("Peter Mesottens"));
	}
	
}