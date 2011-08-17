<?php
class NewsServiceBase {

	public function createNews($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getNews($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateNews(News $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteNews($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getNewss($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countNewss() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("NewsPersistence");
	}

}
?>