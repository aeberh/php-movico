<?php
class StringContainsTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	function testBlankStringIsNeverContained() {
		$this->assertFalse($this->input->contains(""));
	}
	
	function testRealContainedString() {
		$this->assertTrue($this->input->contains("Peter"));
	}
	
	function testFalseContainedString() {
		$this->assertFalse($this->input->contains("Raf"));
	}
	
	function testStringItself() {
		$this->assertTrue($this->input->contains($this->input));
	}
	
	function testLongerThanString() {
		$this->assertFalse($this->input->contains("Peter Mesottens"));
	}
	
}