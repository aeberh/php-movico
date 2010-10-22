<?
class BeanUtil {
	
	const DELIM = "_";
	
	public static function getProperty($beanString) {
		list($className, $propertyName) = explode(self::DELIM, $beanString, 2);
		$instance = BeanLocator::get($className);
		$methodName = "get".ucfirst($propertyName);
		$method = new ReflectionMethod($instance, $methodName);
		return $method->invoke($instance);
	}
	
	public static function setProperty($beanString, $value) {
		list($className, $propertyName) = explode(self::DELIM, $beanString, 2);
		$instance = BeanLocator::get($className);
		$methodName = "set".ucfirst($propertyName);
		$method = new ReflectionMethod($instance, $methodName);
		$method->invoke($instance, $value);
	}
	
	public static function execute($beanString) {
		list($className, $methodName) = explode(self::DELIM, $beanString, 2);
		$instance = BeanLocator::get($className);
		$method = new ReflectionMethod($instance, $methodName);
		return $method->invoke($instance);
	}
	
}
?>