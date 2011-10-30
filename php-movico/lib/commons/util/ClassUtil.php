<?php
class ClassUtil {
	
	public static function isSubclassOf($child, $parent) {
		return $child === $parent || in_array($parent, class_parents($child));
	}
	
}
?>