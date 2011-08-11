<?php
class Params {
	
	private static $params = array();
	
	public static function get($i) {
		return self::$params[$i];
	}
	
	public static function init($params) {
		self::$params = $params;
	}
	
}
?>