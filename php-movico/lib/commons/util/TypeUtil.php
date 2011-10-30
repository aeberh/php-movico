<?php
class TypeUtil {
	
	public static function getType($var) {
		if(!is_object($var)) {
			return gettype($var);
		}
		return get_class($var);
	}
	
	public static function isPrimitive($type) {
		return ArrayList::fromArray("string", array("boolean", "integer", "float", "string"))->contains($type);
	}
	
	public static function isObjectType($type) {
		return !self::isPrimitive($type) && class_exists($type);
	}
	
	public static function isValidType($type) {
		return self::isPrimitive($type) || self::isObjectType($type);
	}
	
	public static function isImplementation($class, $interface) {
		return ArrayList::fromArray("string", class_implements($class))->contains($interface);
	}
	
	public static function isClassComparable($class) {
		return self::isImplementation($class, "Comparable");
	}
	
}
?>