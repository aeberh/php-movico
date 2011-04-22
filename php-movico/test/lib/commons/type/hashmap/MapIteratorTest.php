<?
class MapIteratorTest extends UnitTestCase {
	
	private $map;
	
	public function __construct() {
		$this->map = new HashMap("string", "integer");
		$this->map->put("First", 1);
		$this->map->put("Second", 2);
		$this->map->put("Third", 3);
	}
	
	function testIterate() {
		$result = "";
		foreach($this->map as $key=>$value) {
			$result .= $key.$value;
		}
		$this->assertEqual("First1Second2Third3", $result);
	}
	
}
?>