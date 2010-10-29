<?php
class Property {

	private $name;
	private $type;
	private $size;

	private static $allowedTypes = array("String", "int", "boolean", "Date");

	public function __construct($name, $type, $size) {
		$this->name = $name;
		$this->type = $type;
		$this->size = $size;
		$this->validate();
	}

	public function getName() {
		return $this->name;
	}

	public function getType() {
		return $this->type;
	}
	
	public function getSize() {
		return $this->size;
	}

	public function getDbType() {
		switch($this->type) {
			case "String":
				return $this->size > 500 ? "TEXT" : "VARCHAR(".$this->size.")";
			case "int":
				return "INTEGER";
			case "boolean":
				return "TINYINT(1)";
			case "Date":
				return "DATETIME";
		}
		throw new ServiceBuilderException("'$this->type' is not a valid property type");
	}
	
	public function getConverter() {
		switch($this->type) {
			case "boolean":
				return "BooleanConverter";
			case "Date":
				return "DateConverter";
		}
		return "NullConverter";
	}

	private function validate() {
		if(!in_array($this->type, self::$allowedTypes)) {
			throw new ServiceBuilderException("'$this->type' is not a valid property type");
		}
		if($this->type == "String" && empty($this->size)) {
			throw new ServiceBuilderException("String property '{$this->name}' has no size defined");
		}
	}

	public function getGetter() {
		$getOrIs = ($this->type == "boolean") ? "is" : "get";
		return $getOrIs.ucfirst($this->name)."()";
	}

}
?>
