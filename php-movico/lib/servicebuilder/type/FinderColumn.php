<?php 
class FinderColumn {
	
	private $name;
	private $comparator;
	
	public function __construct($name, $comparator) {
		$this->name = $name;
		$this->comparator = $comparator;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getComparator() {
		return $this->comparator;
	}
	
}
?>