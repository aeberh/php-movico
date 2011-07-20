<?php
class Finder {

	private $name;
	private $unique;
	private $finderColumns;
	private $entity;

	public function __construct(Entity $entity, $name, $unique) {
		$this->name = $name;
		$this->unique = $unique;
		$this->finderColumns = array();
		$this->entity = $entity;
	}

	public function addFinderColumn(FinderColumn $column) {
		$this->finderColumns[] = $column;
	}

	public function getName() {
		return $this->name;
	}

	public function isUnique() {
		return $this->unique;
	}

	public function getColumns() {
		return $this->finderColumns;
	}
	
	public function getMethodSignature($values=true) {
		$v = $values ? "=-1" : "";
		return "findBy{$this->getName()}(".implode(", ", $this->getColumnVariables()).", \$from$v, \$limit$v)";
	}
	
	public function getColumnVariables() {
		$result = array();
		foreach($this->getColumns() as $column) {
			$result[] = "\$".$column->getName();
		}
		return $result;
	}
	
	public function getColumnNames() {
		$result = array();
		foreach($this->getColumns() as $column) {
			$result[] = $column->getName();
		}
		return $result;
	}
	
	public function getWhereClauses() {
		$result = array();
		foreach($this->getColumns() as $column) {
			$converter = $this->entity->getProperty($column->getName())->getConverter();
			$value = "Singleton::create(\"$converter\")->fromDOMtoDB(\$".$column->getName().")";
			$result[] = "`".$column->getName()."`".$column->getComparator()."'\".".$value.".\"'";
		}
		return $result;
	}
	
	public function getIndexDefinition() {
		$result = "KEY `IX_".strtoupper($this->getName())."` (`".implode("`, `", $this->getColumnNames())."`)";
		if($this->isUnique()) {
			$result = "UNIQUE $result";
		}
		return $result;
	}

}
?>
