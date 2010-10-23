<?php
class Property {

	private $name;
	private $type;
	private $length;

	private static $allowedTypes = array("String", "int", "boolean", "Date");

	public function __construct($name, $type, $length) {
		$this->name = $name;
		$this->type = $type;
		$this->length = $length;
		$this->validate();
	}

	public function getName() {
		return $this->name;
	}

	public function getType() {
		return $this->type;
	}
	
	public function getLength() {
		return $this->length;
	}

	public function getDbType() {
		switch($this->type) {
			case "String":
				return $this->length > 500 ? "TEXT" : "VARCHAR(".$this->length.")";
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
	}

	public function getGetter() {
		$getOrIs = ($this->type == "boolean") ? "is" : "get";
		return $getOrIs.ucfirst($this->name)."()";
	}

}
?>
