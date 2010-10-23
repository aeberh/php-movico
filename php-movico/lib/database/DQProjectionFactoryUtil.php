<?php
class DQProjectionFactoryUtil {

	public static function count() {
		return new DQProjection("count(*)");
	}

}
?>
