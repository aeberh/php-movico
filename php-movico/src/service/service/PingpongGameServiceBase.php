<?php
class PingpongGameServiceBase {

	public function createPingpongGame($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getPingpongGame($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updatePingpongGame(PingpongGame $object) {
		return $this->getPersistence()->update($object);
	}

	public function deletePingpongGame($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getPingpongGames($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countPingpongGames() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("PingpongGamePersistence");
	}

}
?>