<?php
class WishListServiceBase {

	public function findByName($name, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByName($name, $from, $limit);
	}

	public function deleteByName($name) {
		$this->getPersistence()->deleteByName($name);
	}

	public function createWishList($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getWishList($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateWishList(WishList $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteWishList($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getWishLists($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countWishLists() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("WishListPersistence");
	}

}
?>