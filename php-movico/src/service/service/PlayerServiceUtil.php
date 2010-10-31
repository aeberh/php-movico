<?php
class PlayerServiceUtil {

	public static function createPlayer($pk=0) {
		return self::getService()->createPlayer($pk);
	}

	public static function getPlayer($pk) {
		return self::getService()->getPlayer($pk);
	}

	public static function updatePlayer(Player $object) {
		return self::getService()->updatePlayer($object);
	}

	public static function deletePlayer($pk) {
		self::getService()->deletePlayer($pk);
	}

	public static function getPlayers() {
		return self::getService()->getPlayers();
	}

	public static function countPlayers() {
		return self::getService()->countPlayers();
	}

	private static function getService() {
		return Singleton::create("PlayerService");
	}

}
?>