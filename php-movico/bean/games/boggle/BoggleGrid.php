<?
class BoggleGrid {
	
	private $layout;
	
	public function __construct(ArrayList $layout) {
		$this->layout = $layout;
	}
	
	public static function create($lang) {
		$content = String::create(file_get_contents("bean/games/boggle/data/blocks/$lang"));
		$layout = new ArrayList("String");
		foreach ($content->split("\n") as $die) {
			$layout->add($die->split(" ")->getRandomElement());
		}
		$layout->shuffle();
		return new BoggleGrid($layout);
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
	public function getChars() {
		return $this->layout->join(",");
	}
	
	public function getColumns() {
		return sqrt($this->layout->size());
	}
	
	public function getIndices(String $char) {
		return $this->layout->indexesOf($char);
	}
	
	public function getRow($index) {
		return floor($index / $this->getColumns());
	}
	
	public function getCol($index) {
		return $index % $this->getColumns(); 
	}
	
	public function isIndicesAdjacent($index1, $index2) {
		$rowDiff = abs($this->getRow($index1)-$this->getRow($index2));
		$colDiff = abs($this->getCol($index1)-$this->getCol($index2));
		return $rowDiff <= 1 && $colDiff <= 1 && ($rowDiff != 0 || $colDiff != 0);
	}
	
	public function getAdjacentIndices($index) {
		$result = new ArrayList("integer");
		for($i=0; $i<$this->layout->size(); $i++) {
			if($this->isIndicesAdjacent($index, $i)) {
				$result[] = $i;
			}
		}
		return $result;
	}

}
?>