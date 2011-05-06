<?php
class TeamServiceBase {

	public function createTeam($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getTeam($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateTeam(Team $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteTeam($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getTeams($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countTeams() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("TeamPersistence");
	}

}
?>