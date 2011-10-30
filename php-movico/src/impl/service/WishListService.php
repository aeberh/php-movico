<?php
class WishListService extends WishListServiceBase {

	public function getOrCreateWishList($name) {
		try {
			return $this->findByName($name);
		} catch(NoSuchWishListException $e) {
			$wl = $this->createWishList();
			$wl->setName($name);
			$wl->setUpdateDate(Date::createNow());
			return $this->updateWishList($wl);
		}
	}
	
	public function save($name, $list) {
		$wl = $this->findByName($name);
		$wl->setList($list);
		$wl->setUpdateDate(Date::createNow());
		$this->updateWishList($wl);
		return $this->getWishList($wl->getId());
	}
	
}
?>