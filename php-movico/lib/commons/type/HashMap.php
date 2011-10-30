<?php
class HashMap implements IteratorAggregate {
	
	private $elements = array();
	private $keyType;
	private $valueType;
	
	public function __construct($keyType="?", $valueType="?") {
		if(!is_string($keyType) || !is_string($valueType)) {
			throw new IllegalArgumentException("Type parameters must be strings");
		}
		$this->keyType = $keyType;
		$this->valueType = $valueType;
	}
	
	public static function fromArray($keyType, $valueType, array $array) {
		$map = new self($keyType, $valueType);
		foreach($array as $key=>$value) {
			$val = is_array($value) ? self::fromArray("?", "?", $value) : $value;
			$map->put($key, $val);
		}
		return $map;
	}
	
	public function toArray() {
		$result = array();
		foreach($this as $key=>$value) {
			$val = ($value instanceof HashMap) ? $value->toArray() : $value;
			$result[$key] = $val;
		}
		return $result;
	}
	
	public function put($key, $value) {
		if(!$this->isCorrectKeyType($key)) {
			throw new IllegalArgumentException("Tried to add element with key of type ".TypeUtil::getType($key)." to map with keys of type ".$this->keyType);
		}
		if(!$this->isCorrectValueType($value)) {
			throw new IllegalArgumentException("Tried to add element with value of type ".TypeUtil::getType($value)." to map with values of type ".$this->valueType);
		}
		$this->elements[$key] = $value;
	}
	
	public function get($key) {
		if(!$this->isCorrectKeyType($key)) {
			throw new IllegalArgumentException("Tried to get element with key of type ".TypeUtil::getType($key)." to map with keys of type ".$this->keyType);
		}
		if(!isset($this->elements[$key])) {
			return null;
		}
		return $this->elements[$key];
	}
	
	public function has($key) {
		return !is_null($this->get($key));
	}
	
	public function size() {
		return count($this->elements);
	}
	
	public function getIterator() {
		return new ArrayIterator($this->elements);
	}
	
	public function __toString() {
		$pairs = new ArrayList("string");
		foreach($this as $key=>$value) {
			$pairs->add("$key:$value");
		}
		return "{".$pairs->join(",")."}";
	}
	
	private function isCorrectKeyType($key) {
		if($this->keyType === "?") {
			return true;
		}
		return $this->keyType === TypeUtil::getType($key);
	}
	
	private function isCorrectValueType($value) {
		if($this->valueType === "?") {
			return true;
		}
		return $this->valueType === TypeUtil::getType($value);
	}
	
}
?>