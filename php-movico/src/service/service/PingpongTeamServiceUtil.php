<?php
class PingpongTeamServiceUtil {

	public static function create($clubId, $teamNo, $recreation) {
		return self::getService()->create($clubId, $teamNo, $recreation);
	}

	public static function getOrCreateClubId($clubId, $teamNo) {
		return self::getService()->getOrCreateClubId($clubId, $teamNo);
	}

	public static function getJevotaTeam($teamNo, $rec) {
		return self::getService()->getJevotaTeam($teamNo, $rec);
	}

	public static function findByClubAndTeam($clubId, $teamNo, $recreation, $from=-1, $limit=-1) {
		return self::getService()->findByClubAndTeam($clubId, $teamNo, $recreation, $from, $limit);
	}

	public static function findByClub($clubId, $from=-1, $limit=-1) {
		return self::getService()->findByClub($clubId, $from, $limit);
	}

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