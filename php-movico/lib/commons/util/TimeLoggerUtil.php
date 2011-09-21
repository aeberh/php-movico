<?
class TimeLoggerUtil {
	
	private static $times = array();
	private static $timers = array();
	
	public static function start($type) {
		self::$timers[$type] = self::getCurrentTime();
	}
	
	public static function end($type) {
		if(!isset(self::$times[$type])) {
			self::$times[$type] = 0;
		}
		self::$times[$type] += (self::getCurrentTime() - self::$timers[$type]);
	}
	
	public static function getTime($type) {
		return self::$times[$type];
	}
	
	private static function getCurrentTime() {
		return gettimeofday(true);
	}
	
}
?>