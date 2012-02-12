<?php
class BoggleGridIndicesTest extends UnitTestCase {
	
	private $grid;
	
	public function __construct() {
		$this->grid = new BoggleGrid(String::fromPrimitives(array(
			"N", "E", "E", "E", 
			"L", "H", "G", "C", 
			"N", "F", "N", "H", 
			"S", "O", "B", "R"
		)));
	}
	
	public function testRowIndex() {
		$this->assertEqual(1, $this->grid->getRow(6));
	}
	
	public function testColIndex() {
		$this->assertEqual(2, $this->grid->getCol(6));
	}
	
	public function testNotAdjacent() {
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 3));
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 5));
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 7));
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 11));
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 12));
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 13));
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 14));
		$this->assertFalse($this->grid->isIndicesAdjacent(5, 15));
	}
	
	public function testAdjacent() {
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 0));
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 1));
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 2));
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 4));
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 6));
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 8));
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 9));
		$this->assertTrue($this->grid->isIndicesAdjacent(5, 10));
	}
	
}
?>