<?php
class InputDateBean extends RequestBean {
	
	private $date;
	private $dateStr;
	
	public function submit() {
		return null;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate(Date $date) {
		$this->date = $date;
	}
	
	public function getDateStr() {
		return "";
	}
	
}