<?php
class InputDateBean extends RequestBean {
	
	private $date;
	private $dateStr;
	
	public function __construct() {
		$this->date = Date::createNow();
	}
	
	public function submit() {
		$this->dateStr = $this->date->format("%c");
		return null;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate(Date $date) {
		$this->date = $date;
	}
	
	public function getDateStr() {
		return $this->dateStr;
	}
	
}