<?php
class ListSortTest extends UnitTestCase {
	
	function testSortPrimitivesNaturalOrdering() {
		$pList = new ArrayList("string");
		$pList->add("b");
		$pList->add("a");
		$pList->add("c");
		
		$pList->sort();
		$this->assertEqual("a", $pList->get(0));
		$this->assertEqual("b", $pList->get(1));
		$this->assertEqual("c", $pList->get(2));
	}
	
	function testSortObjectsNoComparableInterface() {
		$oList = new ArrayList("SampleSortableObject");
		$oList->add(new SampleSortableObject(new String("b")));
		$oList->add(new SampleSortableObject(new String("a")));
		$oList->add(new SampleSortableObject(new String("c")));
		
		$this->expectException("ListNotSortableException");
		$oList->sort();
	}
	
	function testSortObjectsComparableInterface() {
		$oList = new ArrayList("SampleSortableObjectComparable");
		$oList->add(new SampleSortableObjectComparable(new String("b")));
		$oList->add(new SampleSortableObjectComparable(new String("a")));
		$oList->add(new SampleSortableObjectComparable(new String("c")));
		
		$oList->sort();
		
		$this->assertEqual(new String("c"), $oList->get(0)->getField());
		$this->assertEqual(new String("b"), $oList->get(1)->getField());
		$this->assertEqual(new String("a"), $oList->get(2)->getField());
	}
	
	function testSortObjectsComparator() {
		$oList = new ArrayList("SampleSortableObject");
		$oList->add(new SampleSortableObject(new String("b")));
		$oList->add(new SampleSortableObject(new String("a")));
		$oList->add(new SampleSortableObject(new String("c")));
		
		$oList->sort(new SampleSortableObjectComparator());
		
		$this->assertEqual(new String("c"), $oList->get(0)->getField());
		$this->assertEqual(new String("b"), $oList->get(1)->getField());
		$this->assertEqual(new String("a"), $oList->get(2)->getField());
	}

}

class SampleSortableObjectComparator implements Comparator {
	
	public function compare($one, $other) {
		return $other->getField()->compareTo($one->getField());
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

}

class SampleSortableObjectComparable extends SampleSortableObject implements Comparable {
	
	public function compareTo(self $other) {
		return $other->getField()->compareTo($this->getField());
	}
	
}
?>