<?php
class RoleServiceBase {

	public function findByName($name, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByName($name, $from, $limit);
	}

	public function deleteByName($name) {
		$this->getPersistence()->deleteByName($name);
	}

	public function createRole($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getRole($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateRole(Role $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteRole($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getRoles($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countRoles() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("RolePersistence");
	}

	public function findByPlayerId($playerId, $from, $limit) {
		return $this->getPersistence()->findByPlayerId($playerId, $from, $limit);
	}

	public function setUsers($roleId, $playerIds) {
		$this->getPersistence()->setUsers($roleId, $playerIds);
	}

}
?>