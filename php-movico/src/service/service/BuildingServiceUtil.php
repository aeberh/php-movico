<?php
class BuildingServiceUtil {

	public static function createBuilding($pk=0) {
		return self::getService()->createBuilding($pk);
	}

	public static function getBuilding($pk) {
		return self::getService()->getBuilding($pk);
	}

	public static function updateBuilding(Building $object) {
		return self::getService()->updateBuilding($object);
	}

	public static function deleteBuilding($pk) {
		self::getService()->deleteBuilding($pk);
	}

	public static function getBuildings($from=0, $limit=9999999999) {
		return self::getService()->getBuildings($from, $limit);
	}

	public static function countBuildings() {
		return self::getService()->countBuildings();
	}

	private static function getService() {
		return Singleton::create("BuildingService");
	}

}
?>