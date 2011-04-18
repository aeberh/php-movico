<?php
class String {
	
	private $string;
	
	public function __construct($string) {
		$this->string = $string;
	}
	
	public function length() {
		return strlen($this->string);
	}
	
	public function charAt($index) {
		if(!$this->isValidIndex($index)) {
			throw new StringIndexOutOfBoundsException();
		}
		return new String($string[$index]);
	}
	
	public function substring($start, $end=-1) {
		$length = ($end === -1) ? $this->length()-$start : $end-$start;
		return new String(substr($this->string, $start, $length));
	}
	
	public function split($delimiter, $limit=0) {
		return new String(explode($delimiter, $this->string, $limit));
	}
	
	public function toLowerCase() {
		return new String(strtolower($this->string));
	}
	
	public function toUpperCase() {
		return new String(strtoupper($this->string));
	}
	
	public function trim() {
		return new String(trim($this->string));
	}
	
	public function indexOf(String $substring) {
		return strpos($this->string, $substring);
	}
	
	public function contains(String $substring) {
		return $this->indexOf($substring) > -1;
	}
	
	public function startsWith(String $substring) {
		return $this->indexOf($substring) === 0;
	}
	
	public function endsWith(String $substring) {
		$index = $this->length() - $substring->length();
		return $this->indexOf($substring) === $index;
	}
	
	public function __toString() {
		return $this->string;
	}
	
}