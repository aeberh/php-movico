<?php
class BogglePlayerServiceUtil {

	public static function findOrCreate($playerName) {
		return self::getService()->findOrCreate($playerName);
	}

	public static function getPlayerNames($gameId) {
		return self::getService()->getPlayerNames($gameId);
	}

	public static function findByName($name, $from=-1, $limit=-1) {
		return self::getService()->findByName($name, $from, $limit);
	}

	public static function findByGameId($gameId, $from=-1, $limit=-1) {
		return self::getService()->findByGameId($gameId, $from, $limit);
	}

	public static function createBogglePlayer($pk=0) {
		return self::getService()->createBogglePlayer($pk);
	}

	public static function getBogglePlayer($pk) {
		return self::getService()->getBogglePlayer($pk);
	}

	public static function updateBogglePlayer(BogglePlayer $object) {
		return self::getService()->updateBogglePlayer($object);
	}

	public static function deleteBogglePlayer($pk) {
		self::getService()->deleteBogglePlayer($pk);
	}

	public static function getBogglePlayers($from=0, $limit=9999999999) {
		return self::getService()->getBogglePlayers($from, $limit);
	}

	public static function countBogglePlayers() {
		return self::getService()->countBogglePlayers();
	}

	private static function getService() {
		return Singleton::create("BogglePlayerService");
	}

}
?>