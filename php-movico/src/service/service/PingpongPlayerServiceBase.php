<?php
class PingpongPlayerServiceBase {

	public function findByEmailAddress($emailAddress, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByEmailAddress($emailAddress, $from, $limit);
	}

	public function findByActive($active, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByActive($active, $from, $limit);
	}

	public function createPingpongPlayer($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getPingpongPlayer($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updatePingpongPlayer(PingpongPlayer $object) {
		return $this->getPersistence()->update($object);
	}

	public function deletePingpongPlayer($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getPingpongPlayers($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countPingpongPlayers() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("PingpongPlayerPersistence");
	}

	public function findByRoleId($roleId, $from, $limit) {
		return $this->getPersistence()->findByRoleId($roleId, $from, $limit);
	}

	public function setRoles($playerId, $roleIds) {
		$this->getPersistence()->setRoles($playerId, $roleIds);
	}

}
?>