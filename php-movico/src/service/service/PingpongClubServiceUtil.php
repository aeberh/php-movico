<?php
class PingpongClubServiceUtil {

	public static function create($number, $shortName, $name, $building, $street, $place, $distance, $phone) {
		return self::getService()->create($number, $shortName, $name, $building, $street, $place, $distance, $phone);
	}

	public static function update($clubId, $number, $shortName, $name, $building, $street, $place, $distance, $phone) {
		return self::getService()->update($clubId, $number, $shortName, $name, $building, $street, $place, $distance, $phone);
	}

	public static function delete($club) {
		return self::getService()->delete($club);
	}

	public static function getJevota() {
		return self::getService()->getJevota();
	}

	public static function findByName($name, $from=-1, $limit=-1) {
		return self::getService()->findByName($name, $from, $limit);
	}

	public static function deleteByName($name) {
		self::getService()->deleteByName($name);
	}

	public static function findByShortName($shortName, $from=-1, $limit=-1) {
		return self::getService()->findByShortName($shortName, $from, $limit);
	}

	public static function deleteByShortName($shortName) {
		self::getService()->deleteByShortName($shortName);
	}

	public static function findByNumber($number, $from=-1, $limit=-1) {
		return self::getService()->findByNumber($number, $from, $limit);
	}

	public static function deleteByNumber($number) {
		self::getService()->deleteByNumber($number);
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