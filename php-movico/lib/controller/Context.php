<?php
class Context {
	
	private static $params = array();
	private static $sourceView;
	
	public static function hasParam($i) {
		return isset(self::$params[$i]);
	}
	
	public static function getParam($i, $default=null) {
		if(!is_null($default) && !self::has($i)) {
			return $default;
		}
		return self::$params[$i];
	}
	
	public static function initParams($params) {
		self::$params = $params;
	}
	
	public static function setSourceView($view) {
		self::$sourceView = $view;
	}
	
	public static function getSourceView() {
		return self::$sourceView;
	}
	
}
?>