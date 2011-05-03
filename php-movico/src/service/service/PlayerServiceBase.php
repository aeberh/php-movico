<?php
class PlayerServiceBase {

	public function createPlayer($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getPlayer($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updatePlayer(Player $object) {
		return $this->getPersistence()->update($object);
	}

	public function deletePlayer($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getPlayers($from, $limit) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countPlayers() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("PlayerPersistence");
	}

	public function findByTeamId($teamId, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByTeamId($teamId, $from, $limit);
	}

}
?>