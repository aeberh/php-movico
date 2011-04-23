<?
class IsComparableTest extends UnitTestCase {
	
	function testSampleComparable() {
		$this->assertTrue(TypeUtil::isClassComparable("SampleComparable"));
	}
	
	function testSampleNotComparable() {
		$this->assertFalse(TypeUtil::isClassComparable("SampleNotComparable"));
	}
	
}

class SampleNotComparable {
	
}

class SampleComparable implements Comparable {
	
	public function compareTo(self $other) {
		return 0;
	}
	
}
?>