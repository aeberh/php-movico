<?php
class StringIndexesOfTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testBlankStringIsNeverContained() {
		$this->assertEqual(ArrayList::fromArray("integer", array()), $this->input->indexesOf(""));
	}
	
	function testRealContainedString() {
		$this->assertEqual(ArrayList::fromArray("integer", array(2)), $this->input->indexesOf("ter"));
	}
	
	function testFalseContainedString() {
		$this->assertEqual(ArrayList::fromArray("integer", array()), $this->input->indexesOf("QSDqd"));
	}
	
	function testStringItself() {
		$this->assertEqual(ArrayList::fromArray("integer", array(0)), $this->input->indexesOf($this->input));
	}
	
	function testLongerThanString() {
		$this->assertEqual(ArrayList::fromArray("integer", array()), $this->input->indexesOf("Peter Mesottens"));
	}
	
	function testMultipleIndexes() {
		$this->assertEqual(ArrayList::fromArray("integer", array(2, 11)), $this->input->indexesOf("te"));
	}
	
}