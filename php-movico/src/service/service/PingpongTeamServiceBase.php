<?php
class PingpongTeamServiceBase {

	public function findByClubAndTeam($clubId, $teamNo, $recreation, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByClubAndTeam($clubId, $teamNo, $recreation, $from, $limit);
	}

	public function createPingpongTeam($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getPingpongTeam($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updatePingpongTeam(PingpongTeam $object) {
		return $this->getPersistence()->update($object);
	}

	public function deletePingpongTeam($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getPingpongTeams($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countPingpongTeams() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("PingpongTeamPersistence");
	}

}
?>