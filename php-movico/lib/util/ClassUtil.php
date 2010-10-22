<?
class ClassUtil {
	
	public static function isSubclassOf($child, $parent) {
		self::checkClassExists($child);
		self::checkClassExists($parent);
		return in_array($parent, class_parents($child));
	}
	
	private static function checkClassExists($className) {
		if(!class_exists($className)) {
			throw new ClassNotExistsException($className);
		}
	}
	
}
?>