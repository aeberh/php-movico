<?php
class PingpongGameServiceBase {

	public function findByAfterDate($date, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByAfterDate($date, $from, $limit);
	}

	public function deleteByAfterDate($date) {
		$this->getPersistence()->deleteByAfterDate($date);
	}

	public function findByBeforeDate($date, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByBeforeDate($date, $from, $limit);
	}

	public function deleteByBeforeDate($date) {
		$this->getPersistence()->deleteByBeforeDate($date);
	}

	public function findByHomeTeam($homeTeamId, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByHomeTeam($homeTeamId, $from, $limit);
	}

	public function deleteByHomeTeam($homeTeamId) {
		$this->getPersistence()->deleteByHomeTeam($homeTeamId);
	}

	public function findByOutTeam($outTeamId, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByOutTeam($outTeamId, $from, $limit);
	}

	public function deleteByOutTeam($outTeamId) {
		$this->getPersistence()->deleteByOutTeam($outTeamId);
	}

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