<?php
class UserServiceBase {

	public function createUser($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getUser($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateUser(User $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteUser($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getUsers() {
		return $this->getPersistence()->findAll();
	}

	public function countUsers() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("UserPersistence");
	}

}
?>