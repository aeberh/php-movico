<?php
class Finder {

	private $name;
	private $unique;
	private $finderColumns;

	public function __construct($name, $unique) {
		$this->name = $name;
		$this->unique = $unique;
		$this->finderColumns = array();
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
	
	public function getMethodSignature($values) {
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
			$result[] = "`".$column->getName()."`".$column->getComparator()."'\$".$column->getName()."'";
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
