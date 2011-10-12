<?php
class GameParticipanceServiceBase {

	public function findByGameAndTeam($gameId, $teamId, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByGameAndTeam($gameId, $teamId, $from, $limit);
	}

	public function deleteByGameAndTeam($gameId, $teamId) {
		$this->getPersistence()->deleteByGameAndTeam($gameId, $teamId);
	}

	public function createGameParticipance($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getGameParticipance($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateGameParticipance(GameParticipance $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteGameParticipance($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getGameParticipances($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countGameParticipances() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("GameParticipancePersistence");
	}

}
?>