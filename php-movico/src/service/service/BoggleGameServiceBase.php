<?php
class BoggleGameServiceBase {

	public function findByStarted($started, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByStarted($started, $from, $limit);
	}

	public function createBoggleGame($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getBoggleGame($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateBoggleGame(BoggleGame $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteBoggleGame($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getBoggleGames($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countBoggleGames() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("BoggleGamePersistence");
	}

}
?>