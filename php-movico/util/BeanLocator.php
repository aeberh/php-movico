<?
class BeanLocator {
	
	private static $beans = array();
	
	public static function get($className) {
		if(!isset(self::$beans[$className])) {
			self::$beans[$className] = new $className;
		}
		return self::$beans[$className];
	}
	
}
?>