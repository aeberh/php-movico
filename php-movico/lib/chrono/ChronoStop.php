<?php
class ChronoStop {
	
	private $label;
	private $time;
	
	public function __construct($label, $time) {
		$this->label = $label;
		$this->time = $time;
	}
	
	public function getLabel() {
		return $this->label;
	}
	
	public function getTime() {
		return $this->time;
	}
	
}
?>