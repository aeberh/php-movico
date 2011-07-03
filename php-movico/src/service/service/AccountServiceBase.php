<?php
class AccountServiceBase {

	public function findByEmailAddress($emailAddress, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByEmailAddress($emailAddress, $from, $limit);
	}

	public function createAccount($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getAccount($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateAccount(Account $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteAccount($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getAccounts($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countAccounts() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("AccountPersistence");
	}

}
?>