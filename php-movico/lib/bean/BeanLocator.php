<?
class BeanLocator {
	
	private static $requestBeans = array();
	
	public static function get($className) {
		if(self::isRequestBean($className)) {
			return self::getOrCreateRequestBean($className);
		}
		if(self::isSessionBean($className)) {
			return self::getOrCreateSessionBean($className);
		}
		throw new NoSuchBeanException($className);
	}
	
	private static function getOrCreateSessionBean($className) {
		if(!isset($_SESSION[$className])) {
			$_SESSION[$className] = new $className;
		}
		return $_SESSION[$className];
	}
	
	private static function getOrCreateRequestBean($className) {
		if(!isset(self::$requestBeans[$className])) {
			self::$requestBeans[$className] = new $className;
		}
		return self::$requestBeans[$className];
	}
	
	private static function isRequestBean($className) {
		return ClassUtil::isSubclassOf($className, "RequestBean");
	}
		
	private static function isSessionBean($className) {
		return ClassUtil::isSubclassOf($className, "SessionBean");
	}
	
}
?>