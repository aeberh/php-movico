<?php
class BoggleHighScoreServiceUtil {

	public static function create($name, $lang, $grid, $points) {
		return self::getService()->create($name, $lang, $grid, $points);
	}

	public static function findByLang($lang, $from=-1, $limit=-1) {
		return self::getService()->findByLang($lang, $from, $limit);
	}

	public static function createBoggleHighScore($pk=0) {
		return self::getService()->createBoggleHighScore($pk);
	}

	public static function getBoggleHighScore($pk) {
		return self::getService()->getBoggleHighScore($pk);
	}

	public static function updateBoggleHighScore(BoggleHighScore $object) {
		return self::getService()->updateBoggleHighScore($object);
	}

	public static function deleteBoggleHighScore($pk) {
		self::getService()->deleteBoggleHighScore($pk);
	}

	public static function getBoggleHighScores($from=0, $limit=9999999999) {
		return self::getService()->getBoggleHighScores($from, $limit);
	}

	public static function countBoggleHighScores() {
		return self::getService()->countBoggleHighScores();
	}

	private static function getService() {
		return Singleton::create("BoggleHighScoreService");
	}

}
?>