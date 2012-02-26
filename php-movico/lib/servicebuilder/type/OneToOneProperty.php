<?php
class OneToOneProperty extends Property {
	
	private $entityName;
	
	public function __construct($name, $entityName) {
		$this->name = $name;
		$this->entityName = $entityName;
	}
	
	public function getEntityName() {
		return $this->entityName;
	}
	
}
?>