<?php
class AddressServiceBase {

	public function createAddress($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getAddress($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateAddress(Address $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteAddress($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getAddresss($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countAddresss() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("AddressPersistence");
	}

}
?>