<?php
class WishListServiceUtil {

	public static function getOrCreateWishList($name) {
		return self::getService()->getOrCreateWishList($name);
	}

	public static function save($name, $list) {
		return self::getService()->save($name, $list);
	}

	public static function findByName($name, $from=-1, $limit=-1) {
		return self::getService()->findByName($name, $from, $limit);
	}

	public static function deleteByName($name) {
		self::getService()->deleteByName($name);
	}

	public static function createWishList($pk=0) {
		return self::getService()->createWishList($pk);
	}

	public static function getWishList($pk) {
		return self::getService()->getWishList($pk);
	}

	public static function updateWishList(WishList $object) {
		return self::getService()->updateWishList($object);
	}

	public static function deleteWishList($pk) {
		self::getService()->deleteWishList($pk);
	}

	public static function getWishLists($from=0, $limit=9999999999) {
		return self::getService()->getWishLists($from, $limit);
	}

	public static function countWishLists() {
		return self::getService()->countWishLists();
	}

	private static function getService() {
		return Singleton::create("WishListService");
	}

}
?>