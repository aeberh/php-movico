<?
class ListJoinElementsTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("string");
		$this->list->add("First");
		$this->list->add("Second");
		$this->list->add("Third");
	}
	
	function testJoinElementsNormalDelimiter() {
		$this->assertEqual(new String("First|Second|Third"), $this->list->join("|"));
	}
	
	function testJoinEmptyDelimiter() {
		$this->assertEqual(new String("FirstSecondThird"), $this->list->join());
	}
	
	function testJoinObjects() {
		$this->list = new ArrayList("SampleObject");
		$this->list->add(new SampleObject("a"));
		$this->list->add(new SampleObject("b"));
		$this->assertEqual(new String("aa*bb"), $this->list->join("*"));
	}
	
	function testJoinEmptyArray() {
		$this->list = new ArrayList("string");
		$this->assertEqual(new String(""), $this->list->join("*"));
	}

}
	
class SampleObject {

	private $field;
	
	public function __construct($field) {
		$this->field = $field;
	}
	
	public function __toString() {
		return $this->field.$this->field;
	}
	
}
?>