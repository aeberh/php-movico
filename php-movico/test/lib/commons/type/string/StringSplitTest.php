<?php
class StringSplitTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testDelimiterNotPresentReturnsSingleton() {
		$result = $this->input->split("%");
		$this->assertEqual(1, $result->size());
		$this->assertEqual($this->input, $result->get(0));
	}
	
	function testDelimiterPresent() {
		$result = $this->input->split(" ");
		$this->assertEqual(2, $result->size());
		$this->assertEqual(new String("Peter"), $result->get(0));
		$this->assertEqual(new String("Mesotten"), $result->get(1));
	}
	
	function testMultiCharDelimiter() {
		$result = $this->input->split("te");
		$this->assertEqual(3, $result->size());
		$this->assertEqual(new String("Pe"), $result->get(0));
		$this->assertEqual(new String("r Mesot"), $result->get(1));
		$this->assertEqual(new String("n"), $result->get(2));
	}
	
	function testBlankDelimiter() {
		$result = $this->input->split("");
		$this->assertEqual(1, $result->size());
		$this->assertEqual($this->input, $result->get(0));
	}
	
}
?>