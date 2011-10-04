<?php
class PrimaryKeyProperty extends Property {
	
	private $autoIncrement;
	
	public function __construct($name, $type, $size, $autoIncrement) {
		parent::__construct($name, $type, $size);
		$this->autoIncrement = $autoIncrement;
	}
	
	public function isAutoIncrement() {
		return $this->autoIncrement;
	}
	
}
?>