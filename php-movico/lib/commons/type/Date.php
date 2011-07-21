<?
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
	
	public function __toString() {
		return $this->format();
	}
	
}
?>