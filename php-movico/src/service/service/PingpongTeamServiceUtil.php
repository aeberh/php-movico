<?php
class PingpongTeamServiceUtil {

	public static function createPingpongTeam($pk=0) {
		return self::getService()->createPingpongTeam($pk);
	}

	public static function getPingpongTeam($pk) {
		return self::getService()->getPingpongTeam($pk);
	}

	public static function updatePingpongTeam(PingpongTeam $object) {
		return self::getService()->updatePingpongTeam($object);
	}

	public static function deletePingpongTeam($pk) {
		self::getService()->deletePingpongTeam($pk);
	}

	public static function getPingpongTeams($from=0, $limit=9999999999) {
		return self::getService()->getPingpongTeams($from, $limit);
	}

	public static function countPingpongTeams() {
		return self::getService()->countPingpongTeams();
	}

	private static function getService() {
		return Singleton::create("PingpongTeamService");
	}

}
?>