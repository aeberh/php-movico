<?php
class BeanLocator {
	
	private static $existingClasses = array();
	private static $requestBeans = array();
	const APP_SCOPE_FILE = "lib/bean/data/appscope.dat";
	
	public static function get($className) {
		if(!ClassCache::exists($className)) {
			throw new NoSuchBeanException($className);
		}
		if(self::isRequestBean($className)) {
			return self::getOrCreateRequestBean($className);
		}
		if(self::isSessionBean($className)) {
			return self::getOrCreateSessionBean($className);
		}
		if(self::isApplicationBean($className)) {
			return self::getOrCreateApplicationBean($className);
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
	
	private static function getOrCreateApplicationBean($className) {
		try {
			$appBeans = self::getAppBeans();
		} catch(FileNotExistsException $e) {
			FileUtil::createFile(self::APP_SCOPE_FILE);
			$appBeans = array();
		}
		if(!isset($appBeans[$className])) {
			$appBeans[$className] = new $className;
			self::storeAppBeans($appBeans);
		}
		return $appBeans[$className];
	}
	
	public static function storeBean($beanObject) {
		$className = get_class($beanObject);
		if(self::isApplicationBean($className)) {
			$appBeans = self::getAppBeans();
			$appBeans[$className] = $beanObject;
			self::storeAppBeans($appBeans);
		}
	}
	
	private static function getAppBeans() {
		return unserialize(FileUtil::getFileContents(self::APP_SCOPE_FILE));
	}
	
	private static function storeAppBeans($appBeans) {
		FileUtil::storeFileContents(self::APP_SCOPE_FILE, serialize($appBeans));
	}
	
	public static function isRequestBean($className) {
		return ClassUtil::isSubclassOf($className, "RequestBean");
	}
		
	public static function isSessionBean($className) {
		return ClassUtil::isSubclassOf($className, "SessionBean");
	}
	
	public static function isApplicationBean($className) {
		return ClassUtil::isSubclassOf($className, "ApplicationBean");
	}
	
}
?>