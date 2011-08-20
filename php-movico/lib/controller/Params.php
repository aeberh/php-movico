<?php
class Params {
	
	private static $params = array();
	
	public static function has($i) {
		return isset(self::$params[$i]);
	}
	
	public static function get($i, $default=null) {
		if(!is_null($default) && !self::has($i)) {
			return $default;
		}
		return self::$params[$i];
	}
	
	public static function init($params) {
		self::$params = $params;
	}
	
}
?>