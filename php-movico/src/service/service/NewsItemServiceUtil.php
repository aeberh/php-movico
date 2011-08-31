<?php
class NewsItemServiceUtil {

	public static function create($userId, $title, $content) {
		return self::getService()->create($userId, $title, $content);
	}

	public static function update($itemId, $title, $content) {
		return self::getService()->update($itemId, $title, $content);
	}

	public static function createNewsItem($pk=0) {
		return self::getService()->createNewsItem($pk);
	}

	public static function getNewsItem($pk) {
		return self::getService()->getNewsItem($pk);
	}

	public static function updateNewsItem(NewsItem $object) {
		return self::getService()->updateNewsItem($object);
	}

	public static function deleteNewsItem($pk) {
		self::getService()->deleteNewsItem($pk);
	}

	public static function getNewsItems($from=0, $limit=9999999999) {
		return self::getService()->getNewsItems($from, $limit);
	}

	public static function countNewsItems() {
		return self::getService()->countNewsItems();
	}

	private static function getService() {
		return Singleton::create("NewsItemService");
	}

}
?>