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
			if(is_null($object)) {
				throw new NullPointerException();
			}
			$className = get_class($object);
			$isListItem = StringUtil::endsWith($property, ")");
			$strippedProperty = $isListItem ? substr($property, 0, strpos($property, "(")) : $property;
			try {
				$getterMethod = new ReflectionMethod($className, StringUtil::getter($strippedProperty));
			} catch(ReflectionException $e) {
				try {
					$getterMethod = new ReflectionMethod($className, StringUtil::boolGetter($strippedProperty));
				} catch(ReflectionException $e) {
					throw new MethodNotExistsException($className, StringUtil::getter($strippedProperty));
				}
			}
			$object = $getterMethod->invoke($object);
			if($isListItem) {
				$index = StringUtil::getSubstringBetween($property, "(", ")");
				$object = $object[$index];
			}
		}
		return $object;
	}
	
	public static function callNestedSetter($object, $nestedProperty, $value) {
		StringUtil::checkTypes($nestedProperty);
		$properties = explode(".", $nestedProperty);
		$setterProperty = ArrayUtil::getLastValue($properties);
		$getterProperties = ArrayUtil::getAllExceptLast($properties);
		$objToSet = $object;
		if(!ArrayUtil::isEmpty($getterProperties)) {
			$getterProps = implode(".", $getterProperties);
			$objToSet = self::callNestedGetter($objToSet, $getterProps);
		}
		if(is_null($objToSet)) {
			throw new NullPointerException();
		}
		$setterMethod = new ReflectionMethod(get_class($objToSet), StringUtil::setter($setterProperty));
		$setterMethod->invoke($objToSet, $value);
		BeanLocator::storeBean($objToSet);
	}
	
	public static function callMethod($object, $methodName) {
		$method = new ReflectionMethod(get_class($object), $methodName);
		$result = $method->invoke($object);
		BeanLocator::storeBean($object);
		return $result;
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
