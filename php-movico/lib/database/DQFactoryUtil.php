<?php
class DQFactoryUtil {

	public static function forClass($className, $dbManager) {
		return new DynamicQuery($className, $dbManager);
	}

}
?>
