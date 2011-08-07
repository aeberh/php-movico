<?php
class ApplicationConstants extends ApplicationBean {
	
	const DAY_FORMAT = "%a";
	const DATE_FORMAT = "%d-%m-%Y";
	const TIME_FORMAT = "%H:%M";
	
	private $teamNos;
	private $rankings;
	
	public function __construct() {
		$this->teamNos = ArrayUtil::makeAssociative(
			array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", 
			"REC A", "REC B", "REC C", "REC D", "REC E", "REC F",
			"REC G", "REC H", "REC I", "REC J")
		);
		$this->rankings = ArrayUtil::makeAssociative(
			array("NG", "E6", "E4", "E2", "E0", "D6", "D4", "D2", "D0",
			"C6", "C4", "C2", "C0")
		);
	}
	
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
	
	public function getTeamNos() {
		return $this->teamNos;
	}
	
	public function getRankings() {
		return $this->rankings;
	}
	
}
?>