<?php
class BoggleGameServiceUtil {

	public static function getUnstartedGames() {
		return self::getService()->getUnstartedGames();
	}

	public static function createGame($playerId) {
		return self::getService()->createGame($playerId);
	}

	public static function findByStarted($started, $from=-1, $limit=-1) {
		return self::getService()->findByStarted($started, $from, $limit);
	}

	public static function createBoggleGame($pk=0) {
		return self::getService()->createBoggleGame($pk);
	}

	public static function getBoggleGame($pk) {
		return self::getService()->getBoggleGame($pk);
	}

	public static function updateBoggleGame(BoggleGame $object) {
		return self::getService()->updateBoggleGame($object);
	}

	public static function deleteBoggleGame($pk) {
		self::getService()->deleteBoggleGame($pk);
	}

	public static function getBoggleGames($from=0, $limit=9999999999) {
		return self::getService()->getBoggleGames($from, $limit);
	}

	public static function countBoggleGames() {
		return self::getService()->countBoggleGames();
	}

	private static function getService() {
		return Singleton::create("BoggleGameService");
	}

}
?>