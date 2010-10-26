<?php
class ArrayUtil {

	public static function checkTypes() {
		foreach (func_get_args() as $arg) {
			if(!is_array($arg)) {
				throw new InvalidTypeException("Expected type 'array' but was '".gettype($arg)."'");
			}
		}
	}

	public static function merge($array1, $array2) {
		self::checkTypes($array1, $array2);
		return array_merge($array1, $array2);
	}

	public static function isAssociative($array) {
		self::checkTypes($array);
		return array_keys($array) !== array_keys(array_keys($array));
	}
	
	public static function makeAssociative($array) {
		self::checkTypes($array);
		if(self::isAssociative($array)) {
			return $array;
		}
		return array_combine($array, $array);
	}

	public static function contains($array, $element) {
		self::checkTypes($array);
		return in_array($element, $array);
	}

	public static function remove(&$array, $value) {
		self::checkTypes($array);
		$index = array_search($value, $array, true);
		if($index !== false) {
			unset($array[$index]);
		}
	}

	public static function toIndexedArray($objects, $key, $value) {
		self::checkTypes($objects);
		StringUtil::checkTypes($key, $value);
		if(empty($objects))
			return array();
		$result = array();
		foreach($objects as $object) {
			$keyString = ReflectionUtil::callNestedGetter($object, $key);
			$valueString = ReflectionUtil::callNestedGetter($object, $value);
			$result[$keyString] = $valueString;
		}
		return $result;
	}
	
	public static function isEmpty($array) {
		self::checkTypes($array);
		return count($array)==0;
	}
	
	public static function getFirstValue($array) {
		if(self::isEmpty($array)) {
			throw new IndexOutOfBoundsException();
		}
		return current($array);
	}
	
	public static function getAllExceptLast($array) {
		if(count($array)<=1) {
			return array();
		}
		$result = array();
		for($i=0; $i<count($array)-1; $i++) {
			$result[] = $array[$i];
		}
		return $result;
	}
	
	public static function getLastValue($array) {
		if(self::isEmpty($array)) {
			throw new IndexOutOfBoundsException();
		}
		return $array[count($array)-1];
	}
	
	public static function getFirstKey($array) {
		self::checkTypes($array);
		$array = array_flip($array);
		return self::getFirstValue($array);
	}

}
?>
