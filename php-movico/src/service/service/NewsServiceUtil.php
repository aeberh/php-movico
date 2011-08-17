<?php
class NewsServiceUtil {

	public static function createNews($pk=0) {
		return self::getService()->createNews($pk);
	}

	public static function getNews($pk) {
		return self::getService()->getNews($pk);
	}

	public static function updateNews(News $object) {
		return self::getService()->updateNews($object);
	}

	public static function deleteNews($pk) {
		self::getService()->deleteNews($pk);
	}

	public static function getNewss($from=0, $limit=9999999999) {
		return self::getService()->getNewss($from, $limit);
	}

	public static function countNewss() {
		return self::getService()->countNewss();
	}

	private static function getService() {
		return Singleton::create("NewsService");
	}

}
?>