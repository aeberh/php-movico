<?php
class PingpongGameServiceUtil {

	public static function create($date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo) {
		return self::getService()->create($date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo);
	}

	public static function delete($game) {
		return self::getService()->delete($game);
	}

	public static function update($gameId, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review) {
		return self::getService()->update($gameId, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review);
	}

	public static function getFirstUpcomingGames() {
		return self::getService()->getFirstUpcomingGames();
	}

	public static function getRecentlyPlayedGames() {
		return self::getService()->getRecentlyPlayedGames();
	}

	public static function findByAfterDate($date, $from=-1, $limit=-1) {
		return self::getService()->findByAfterDate($date, $from, $limit);
	}

	public static function findByBeforeDate($date, $from=-1, $limit=-1) {
		return self::getService()->findByBeforeDate($date, $from, $limit);
	}

	public static function findByHomeTeam($homeTeamId, $from=-1, $limit=-1) {
		return self::getService()->findByHomeTeam($homeTeamId, $from, $limit);
	}

	public static function findByOutTeam($outTeamId, $from=-1, $limit=-1) {
		return self::getService()->findByOutTeam($outTeamId, $from, $limit);
	}

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