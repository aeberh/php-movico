<?php
class MovicoPostVar {
	
	private $name;
	private $value;
	private $type = null;
	
	public function __construct($name, $value, $type) {
		$this->name = $name;
		$this->value = $value;
		$this->type = $type;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getConvertedValue() {
		return $this->getConverter()->fromViewToDom($this->value);
	}
	
	private function getConverter() {
		$t = is_null($this->type) ? "Null" : $this->type;
		return Singleton::create("Domain{$t}Converter");
	}
	
}
?>