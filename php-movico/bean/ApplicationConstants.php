<?php
class ApplicationConstants extends ApplicationBean {
	
	const DAY_FORMAT = "%a";
	const DATE_FORMAT = "%d-%m-%Y";
	const TIME_FORMAT = "%H:%M";
	
	public function getDayFormat() {
		return self::DAY_FORMAT;
	}
	
	public function getDateFormat() {
		return self::DATE_FORMAT;
	}
	
	public function getTimeFormat() {
		return self::TIME_FORMAT;
	}
	
	public function getDateTimeFormat() {
		return self::DATE_FORMAT." ".self::TIME_FORMAT;
	}
	
}
?>