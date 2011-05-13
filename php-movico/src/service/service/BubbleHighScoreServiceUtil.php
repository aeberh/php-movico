<?php
class BubbleHighScoreServiceUtil {

	public static function create($playerName, $seconds) {
		return self::getService()->create($playerName, $seconds);
	}

	public static function createBubbleHighScore($pk=0) {
		return self::getService()->createBubbleHighScore($pk);
	}

	public static function getBubbleHighScore($pk) {
		return self::getService()->getBubbleHighScore($pk);
	}

	public static function updateBubbleHighScore(BubbleHighScore $object) {
		return self::getService()->updateBubbleHighScore($object);
	}

	public static function deleteBubbleHighScore($pk) {
		self::getService()->deleteBubbleHighScore($pk);
	}

	public static function getBubbleHighScores($from=0, $limit=9999999999) {
		return self::getService()->getBubbleHighScores($from, $limit);
	}

	public static function countBubbleHighScores() {
		return self::getService()->countBubbleHighScores();
	}

	private static function getService() {
		return Singleton::create("BubbleHighScoreService");
	}

}
?>