<?php
class BogglePlayerServiceBase {

	public function findByName($name, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByName($name, $from, $limit);
	}

	public function createBogglePlayer($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getBogglePlayer($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateBogglePlayer(BogglePlayer $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteBogglePlayer($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getBogglePlayers($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countBogglePlayers() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("BogglePlayerPersistence");
	}

	public function findByGameId($gameId, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByGameId($gameId, $from, $limit);
	}

}
?>