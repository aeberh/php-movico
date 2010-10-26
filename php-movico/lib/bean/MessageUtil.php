<? 
class MessageUtil {
	
	private static $msg;
	
	public static function info($msg) {
		self::setMessage(BeanMessage::SEVERITY_INFO, $msg);
	}
	
	public static function error($msg) {
		self::setMessage(BeanMessage::SEVERITY_ERROR, $msg);
	}
	
	private static function setMessage($severity, $msg) {
		self::$msg = new BeanMessage($severity, $msg);
	}
	
	public static function getMessage() {
		return self::$msg;
	}
	
	public static function hasMessage() {
		return isset(self::$msg);
	}
	
}
?>