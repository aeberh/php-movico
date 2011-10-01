<?php
class Context {
	
	private static $params = array();
	
	public static function hasParam($i) {
		return isset(self::$params[$i]);
	}
	
	public static function getParam($i, $default=null) {
		if(!self::hasParam($i)) {
			return $default;
		}
		return self::$params[$i];
	}
	
	public static function initParams($params) {
		self::$params = $params;
	}
	
}
?>