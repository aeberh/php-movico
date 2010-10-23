<?php
class DQPropertyFactoryUtil {

	public static function forName($propertyName) {
		return new DQProperty($propertyName);
	}

}
?>
