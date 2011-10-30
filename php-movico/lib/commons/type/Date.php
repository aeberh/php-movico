<?php
class Date {
	
	private $time;
	const DEFAULT_FORMAT = "%c";
	
	private function __construct($time) {
		$this->time = $time;
	}
	
	public static function createNow() {
		return self::create(time());
	}
	
	public static function create($time) {
		return new Date($time);
	}
	
	public static function fromString($dateStr, $format=self::DEFAULT_FORMAT) {
		$a = strptime($dateStr, $format);
		return self::create(mktime($a["tm_hour"], $a["tm_min"], $a["tm_sec"], $a["tm_mon"]+1, $a["tm_mday"], $a["tm_year"]+1900));
	}

	public function format($format=self::DEFAULT_FORMAT) {
		return strftime($format, $this->time);
	}
	
	public function minusDays($nbDays) {
		return Date::create($this->time - $nbDays*24*60*60);
	}
	
	public function plusDays($nbDays) {
		return Date::create($this->time + $nbDays*24*60*60);
	}
	
	public function getDay() {
		return $this->getIntField("%d");
	}
	
	public function getMonth() {
		return $this->getIntField("%m");
	}
	
	public function getYear() {
		return $this->getIntField("%Y");
	}
	
	public function getHour() {
		return $this->getIntField("%H");
	}
	
	public function getMinutes() {
		return $this->getIntField("%M");
	}
	
	public function getSeconds() {
		return $this->getIntField("%S");
	}
	
	public function getWeek() {
		return $this->getIntField("%W");
	}
	
	private function getIntField($char) {
		return intval($this->format($char));
	}
	
	public function isAfter(Date $other) {
		return $this->time > $other->time;
	}
	
	public function isBefore(Date $other) {
		return $this->time < $other->time;
	}
	
	public function getTime() {
		return $this->time;
	}
	
	public function __toString() {
		return $this->format();
	}
	
}
?>