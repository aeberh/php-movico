<?php
class BoggleGuessedWordServiceUtil {

	public static function createBoggleGuessedWord($pk=0) {
		return self::getService()->createBoggleGuessedWord($pk);
	}

	public static function getBoggleGuessedWord($pk) {
		return self::getService()->getBoggleGuessedWord($pk);
	}

	public static function updateBoggleGuessedWord(BoggleGuessedWord $object) {
		return self::getService()->updateBoggleGuessedWord($object);
	}

	public static function deleteBoggleGuessedWord($pk) {
		self::getService()->deleteBoggleGuessedWord($pk);
	}

	public static function getBoggleGuessedWords($from=0, $limit=9999999999) {
		return self::getService()->getBoggleGuessedWords($from, $limit);
	}

	public static function countBoggleGuessedWords() {
		return self::getService()->countBoggleGuessedWords();
	}

	private static function getService() {
		return Singleton::create("BoggleGuessedWordService");
	}

}
?>