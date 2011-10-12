<?php
class GameParticipanceServiceUtil {

	public static function update($gameId, $teamId, $participants) {
		return self::getService()->update($gameId, $teamId, $participants);
	}

	public static function findByGameAndTeam($gameId, $teamId, $from=-1, $limit=-1) {
		return self::getService()->findByGameAndTeam($gameId, $teamId, $from, $limit);
	}

	public static function deleteByGameAndTeam($gameId, $teamId) {
		self::getService()->deleteByGameAndTeam($gameId, $teamId);
	}

	public static function createGameParticipance($pk=0) {
		return self::getService()->createGameParticipance($pk);
	}

	public static function getGameParticipance($pk) {
		return self::getService()->getGameParticipance($pk);
	}

	public static function updateGameParticipance(GameParticipance $object) {
		return self::getService()->updateGameParticipance($object);
	}

	public static function deleteGameParticipance($pk) {
		self::getService()->deleteGameParticipance($pk);
	}

	public static function getGameParticipances($from=0, $limit=9999999999) {
		return self::getService()->getGameParticipances($from, $limit);
	}

	public static function countGameParticipances() {
		return self::getService()->countGameParticipances();
	}

	private static function getService() {
		return Singleton::create("GameParticipanceService");
	}

}
?>