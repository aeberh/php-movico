<?php
class PingpongPlayerServiceUtil {

	public static function getActivePlayers() {
		return self::getService()->getActivePlayers();
	}

	public static function create($firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		return self::getService()->create($firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone);
	}

	public static function update($playerId, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		return self::getService()->update($playerId, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone);
	}

	public static function findByActive($active, $from=-1, $limit=-1) {
		return self::getService()->findByActive($active, $from, $limit);
	}

	public static function createPingpongPlayer($pk=0) {
		return self::getService()->createPingpongPlayer($pk);
	}

	public static function getPingpongPlayer($pk) {
		return self::getService()->getPingpongPlayer($pk);
	}

	public static function updatePingpongPlayer(PingpongPlayer $object) {
		return self::getService()->updatePingpongPlayer($object);
	}

	public static function deletePingpongPlayer($pk) {
		self::getService()->deletePingpongPlayer($pk);
	}

	public static function getPingpongPlayers($from=0, $limit=9999999999) {
		return self::getService()->getPingpongPlayers($from, $limit);
	}

	public static function countPingpongPlayers() {
		return self::getService()->countPingpongPlayers();
	}

	private static function getService() {
		return Singleton::create("PingpongPlayerService");
	}

}
?>