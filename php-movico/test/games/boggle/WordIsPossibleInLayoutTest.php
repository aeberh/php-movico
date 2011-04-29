<?
class WordIsPossibleInLayoutTest extends UnitTestCase {
	
	private $grid;
	
	public function __construct() {
		$this->grid = new BoggleGrid(String::fromPrimitives(array(
			"N", "E", "E", "E", 
			"L", "H", "G", "C", 
			"N", "F", "N", "H", 
			"S", "O", "B", "R"
		)));
	}
	
	public function testImpossibleWord() {
		$this->doCheck("BEEK", false);
	}
	
	public function testCharNotInLayout() {
		$this->doCheck("XENON", false);
	}
	
	public function testSameCharUsedTwice() {
		$this->doCheck("ENE", false);
	}
	
	public function testPossibleWords() {
		$this->doCheck("GNOFBHCEELNS", true);
		$this->doCheck("RNBH", true);
		$this->doCheck("HEEC", true);
		$this->doCheck("FGECH", true);
		$this->doCheck("SNOFLN", true);
	}
	
	private function doCheck($word, $possible) {
		$w = new BoggleWord($word);
		$this->assertEqual($possible, $w->isPossibleInLayout($this->grid));
	}
	
}
?>