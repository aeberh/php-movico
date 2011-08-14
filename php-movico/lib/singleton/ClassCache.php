<?php
class ClassCache {
	
	private static $classes = null;
	
	public static function init($classes) {
		self::$classes = $classes;
	}
	
	public static function exists($className) {
		return in_array($className, self::$classes);
	}
	
}
?>