<?php
class TeamServiceUtil {

	public static function createTeam($pk=0) {
		return self::getService()->createTeam($pk);
	}

	public static function getTeam($pk) {
		return self::getService()->getTeam($pk);
	}

	public static function updateTeam(Team $object) {
		return self::getService()->updateTeam($object);
	}

	public static function deleteTeam($pk) {
		self::getService()->deleteTeam($pk);
	}

	public static function getTeams() {
		return self::getService()->getTeams();
	}

	public static function countTeams() {
		return self::getService()->countTeams();
	}

	private static function getService() {
		return Singleton::create("TeamService");
	}

}
?>