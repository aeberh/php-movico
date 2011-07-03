<?php
class PingpongMatchServiceBase {

	public function createPingpongMatch($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getPingpongMatch($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updatePingpongMatch(PingpongMatch $object) {
		return $this->getPersistence()->update($object);
	}

	public function deletePingpongMatch($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getPingpongMatchs($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countPingpongMatchs() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("PingpongMatchPersistence");
	}

}
?>