<?php
class NewsItemServiceBase {

	public function createNewsItem($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getNewsItem($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateNewsItem(NewsItem $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteNewsItem($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getNewsItems($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countNewsItems() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("NewsItemPersistence");
	}

}
?>