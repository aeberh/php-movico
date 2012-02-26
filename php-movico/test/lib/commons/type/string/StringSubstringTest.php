<?php
class StringSubstringTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Peter Mesotten");
	}
	
	public function testNormalBehavior() {
		$this->assertEqual(String::create("er Me"), $this->input->substring(3, 8));
	}
	
	public function testStartIndexNegativeThrowsException() {
		$this->expectException(new IndexOutOfBoundsException());
		$this->input->substring(-2);
	}
	
	public function testStartIndexLargerThanEndIndexThrowsException() {
		$this->expectException(new IndexOutOfBoundsException());
		$this->input->substring(5, 1);
	}
	
	public function testEndIndexLargerThanStringLengthThrowsException() {
		$this->expectException(new IndexOutOfBoundsException());
		$this->input->substring(0, $this->input->length()+1);
	}
	
	public function testStartIndexEqualToEndIndex() {
		$this->assertEqual(String::BLANK(), $this->input->substring(3, 3));
	}
	
}