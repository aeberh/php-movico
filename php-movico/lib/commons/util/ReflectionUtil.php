<?php
class ReflectionUtil {

	/**
	 * $value = callNestedGetter($person, "name.firstName")
	 */
	public static function callNestedGetter($object, $nestedProperty) {
		StringUtil::checkTypes($nestedProperty);
		$properties = explode(".", $nestedProperty);
		if(empty($properties) || !is_object($object)) {
			throw new InvalidTypeException("Should be called on object");
		}
		foreach($properties as $property) {
			$className = get_class($object);
			$getterMethod = new ReflectionMethod($className, StringUtil::getter($property));
			$object = $getterMethod->invoke($object);
		}
		return $object;
	}
	
	public static function callNestedSetter($object, $nestedProperty, $value) {
		StringUtil::checkTypes($nestedProperty);
		$properties = explode(".", $nestedProperty);
		$setterProperty = ArrayUtil::getLastValue($properties);
		$getterProperties = ArrayUtil::getAllExceptLast($properties);
		if(!ArrayUtil::isEmpty($getterProperties)) {
			$getterProps = implode(".", ArrayUtil::getAllExceptLast($properties));
			$object = self::callNestedGetter($object, $getterProperties);
		}
		$setterMethod = new ReflectionMethod(get_class($object), StringUtil::setter($setterProperty));
		$setterMethod->invokeArgs($object, array($value));
	}
	
	public static function callMethod($object, $methodName) {
		$method = new ReflectionMethod(get_class($object), $methodName);
		return $method->invoke($object);
	}
	
	public static function getSubclassMethods($className) {
		$reflectionClass = new ReflectionClass($className);
		$result = array();
		foreach($reflectionClass->getMethods() as $method) {
			if($method->class == $className) {
				$result[] = $method;
			}
		}
		return $result;
	}

}
?>
