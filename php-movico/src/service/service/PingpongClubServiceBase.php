<?php
class PingpongClubServiceBase {

	public function findByName($name, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByName($name, $from, $limit);
	}

	public function createPingpongClub($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getPingpongClub($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updatePingpongClub(PingpongClub $object) {
		return $this->getPersistence()->update($object);
	}

	public function deletePingpongClub($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getPingpongClubs($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countPingpongClubs() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("PingpongClubPersistence");
	}

}
?>