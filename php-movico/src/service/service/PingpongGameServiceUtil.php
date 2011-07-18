<?php
class PingpongGameServiceUtil {

	public static function createPingpongGame($pk=0) {
		return self::getService()->createPingpongGame($pk);
	}

	public static function getPingpongGame($pk) {
		return self::getService()->getPingpongGame($pk);
	}

	public static function updatePingpongGame(PingpongGame $object) {
		return self::getService()->updatePingpongGame($object);
	}

	public static function deletePingpongGame($pk) {
		self::getService()->deletePingpongGame($pk);
	}

	public static function getPingpongGames($from=0, $limit=9999999999) {
		return self::getService()->getPingpongGames($from, $limit);
	}

	public static function countPingpongGames() {
		return self::getService()->countPingpongGames();
	}

	private static function getService() {
		return Singleton::create("PingpongGameService");
	}

}
?>