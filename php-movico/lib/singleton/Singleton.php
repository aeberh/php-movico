<?php
class Singleton {

	private static $instances = array();

	public static function create($className) {
		if(!self::isInstantiated($className)) {
			self::doInstantiate($className);
		}
		return self::getInstance($className);
	}

	private static function isInstantiated($className) {
		return array_key_exists($className, self::$instances);
	}

	private static function doInstantiate($className) {
		if(!class_exists($className)) {
			throw new SingletonException("Cannot create singleton for class $className: class does not exist.");
		}
		$name = new $className;
		self::$instances[$className] = $name;
	}

	private static function getInstance($className) {
		return self::$instances[$className];
	}

}
?>
