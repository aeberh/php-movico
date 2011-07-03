<?php
class PingpongMatchServiceUtil {

	public static function createPingpongMatch($pk=0) {
		return self::getService()->createPingpongMatch($pk);
	}

	public static function getPingpongMatch($pk) {
		return self::getService()->getPingpongMatch($pk);
	}

	public static function updatePingpongMatch(PingpongMatch $object) {
		return self::getService()->updatePingpongMatch($object);
	}

	public static function deletePingpongMatch($pk) {
		self::getService()->deletePingpongMatch($pk);
	}

	public static function getPingpongMatchs($from=0, $limit=9999999999) {
		return self::getService()->getPingpongMatchs($from, $limit);
	}

	public static function countPingpongMatchs() {
		return self::getService()->countPingpongMatchs();
	}

	private static function getService() {
		return Singleton::create("PingpongMatchService");
	}

}
?>