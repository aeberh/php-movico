<?
class Date {
	
	private $time;
	const DEFAULT_FORMAT = "d/m/y G:i";
	
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
		$a = date_parse_from_format($format, $dateStr);
		return self::create(mktime($a["hour"], $a["minute"], $a["second"], $a["month"], $a["day"], $a["year"]));
	}

	public function format($format=self::DEFAULT_FORMAT) {
		return date($format, $this->time);
	}
	
	public function __toString() {
		return $this->format();
	}
	
}
?>