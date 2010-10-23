<?
class BeanUtil {
	
	const DELIM = ".";
	const POST_DELIM = "_";
	
	public static function getBeanString($valueExpression) {
		return str_replace("}", "", str_replace("#{", "", $valueExpression));
	}
	
	public static function getBeanAndProperties($valueExpression, $fromPost=false) {
		$beanString = str_replace("}", "", str_replace("#{", "", $valueExpression));
		$delim = $fromPost ? self::POST_DELIM : self::DELIM;
		$result = explode($delim, $beanString, 2);
		return array($result[0], str_replace(self::POST_DELIM, self::DELIM, $result[1]));
	}
//	
//	public static function getProperty($beanString) {
//		list($className, $propertyName) = explode(self::DELIM, $beanString, 2);
//		$instance = BeanLocator::get($className);
//		return ReflectionUtil::callNestedGetter($instance, $propertyName);
////		$methodName = "get".ucfirst($propertyName);
////		$method = new ReflectionMethod($instance, $methodName);
////		return $method->invoke($instance);
//	}
//	
//	public static function setProperty($beanString, $value) {
//		list($className, $propertyName) = explode(self::DELIM, $beanString, 2);
//		$instance = BeanLocator::get($className);
//		$methodName = "set".ucfirst($propertyName);
//		$method = new ReflectionMethod($instance, $methodName);
//		$method->invoke($instance, $value);
//	}
//	
//	public static function execute($beanString) {
//		list($className, $methodName) = explode(self::DELIM, $beanString, 2);
//		$instance = BeanLocator::get($className);
//		$method = new ReflectionMethod($instance, $methodName);
//		return $method->invoke($instance);
//	}
	
	public static function isBeanReference($beanString) {
		return StringUtil::contains($beanString, self::DELIM);
	}
	
}
?>