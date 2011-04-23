<?
class ListSortTest extends UnitTestCase {
	
	private $list;
	
	public function __construct() {
		$this->list = new ArrayList("string");
		$this->list->add("b");
		$this->list->add("a");
		$this->list->add("c");
	}
	
	function testSortPrimitivesNaturalOrdering() {
		$this->list->sort();
		$this->assertEqual("a", $this->list->get(0));
		$this->assertEqual("b", $this->list->get(1));
		$this->assertEqual("c", $this->list->get(2));
	}
	
	function testSortObjectsNaturalOrdering() {
		
	}
	
	function testSortObjectsComparator() {
		$list = new ArrayList("SampleSortableObject");
		$list->add(new SampleSortableObject(new String("b")));
		$list->add(new SampleSortableObject(new String("a")));
		$list->add(new SampleSortableObject(new String("c")));
		$list->sort(new SampleSortableObjectComparator());
		
		$this->assertEqual(new String("c"), $list->get(0)->getField());
		$this->assertEqual(new String("b"), $list->get(1)->getField());
		$this->assertEqual(new String("a"), $list->get(2)->getField());
	}

}

class SampleSortableObjectComparator implements Comparator {
	
	public function compare($one, $other) {
		return $one->compareTo($other);
	}
	
}

class SampleSortableObject {

	private $field;
	
	public function __construct(String $field) {
		$this->field = $field;
	}
	
	public function getField() {
		return $this->field;
	}
	
	public function compareTo(SampleSortableObject $other) {
		return $other->getField()->compareTo($this->getField());
	}
	
}
?>