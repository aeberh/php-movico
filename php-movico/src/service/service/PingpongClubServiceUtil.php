<?php
class PingpongClubServiceUtil {

	public static function create($number, $name, $location) {
		return self::getService()->create($number, $name, $location);
	}

	public static function update($clubId, $location) {
		return self::getService()->update($clubId, $location);
	}

	public static function delete($club) {
		return self::getService()->delete($club);
	}

	public static function findByName($name, $from=-1, $limit=-1) {
		return self::getService()->findByName($name, $from, $limit);
	}

	public static function createPingpongClub($pk=0) {
		return self::getService()->createPingpongClub($pk);
	}

	public static function getPingpongClub($pk) {
		return self::getService()->getPingpongClub($pk);
	}

	public static function updatePingpongClub(PingpongClub $object) {
		return self::getService()->updatePingpongClub($object);
	}

	public static function deletePingpongClub($pk) {
		self::getService()->deletePingpongClub($pk);
	}

	public static function getPingpongClubs($from=0, $limit=9999999999) {
		return self::getService()->getPingpongClubs($from, $limit);
	}

	public static function countPingpongClubs() {
		return self::getService()->countPingpongClubs();
	}

	private static function getService() {
		return Singleton::create("PingpongClubService");
	}

}
?>